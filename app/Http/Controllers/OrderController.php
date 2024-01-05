<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Order;
use App\Models\TradingPair;
use App\Models\Transaction;
use App\Models\User;
use App\Services\OrderService;
use Auth;
use DB;
use Illuminate\Http\Request;
use Response;

class OrderController extends Controller
{
    public function index()
    {
        return view('order.index');
    }

    public function buy()
    {
        $currencies = Currency::where('status', true)->get();

        return view('order.buy', [
            'currencies' => $currencies,
        ]);
    }

    public function sell()
    {
        $currencies = Currency::where('status', true)->get();

        return view('order.sell', [
            'currencies' => $currencies,
        ]);
    }

    public function sellProcess(Request $request)
    {
        return $this->processOrder($request, 'sell');
    }


    public function buyProcess(Request $request)
    {
        return $this->processOrder($request, 'buy');
    }

    public function buyOrders()
    {
        $orders = Order::where('user_id', Auth::user()->id)
            ->where('type', 'buy')
            ->latest('created_at')
            ->get();

        return response()->json($orders);
    }

    public function cancel(Request $request)
    {
        try {
            DB::beginTransaction();

            $order = Order::find($request->post('id'));

            if (!$order) {
                return response()->json([
                    'error' => __('Order not found'),
                    'status' => 'error',
                ], 404);
            }

            $transaction = $order->transactions->first();

            if (!$transaction) {
                return response()->json([
                    'error' => __('Transaction not found'),
                    'status' => 'error',
                ], 404);
            }

            $order->status = 'closed';
            $order->save();

            $transaction->status = 'cancel';
            $transaction->save();

            $user = User::find(Auth::user()->id);
            $currentWallet = $user->wallets()
                ->where('curr', $transaction->quote_currency)
                ->firstOrFail();

            $currentWallet->balance += $transaction->total;
            $currentWallet->save();

            Transaction::create([
                'user_id' => $user->id,
                'order_id' => $order->id,
                'type' => 'refund',
                'currency_pair' =>  $transaction->currency_pair,
                'base_currency' => $transaction->base_currency,
                'quote_currency' => $transaction->quote_currency,
                'amount' => $transaction->amount,
                'fee' => $transaction->fee,
                'total' => $transaction->total,
                'status' => 'success',
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => __('Error during order cancellation'),
                'status' => 'error',
            ], 500);
        }

        return response()->json([
            'message' => __('Order successfully closed'),
            'status' => 'success',
        ], 200);
    }

    protected function processOrder($request, $type)
    {
        $service = OrderService::init($request->all());
        $service->type($type);

        if (!$service->validate()) {
            return response()->json(['error' => $service->getErrors()], 422);
        }

        if ($type === 'buy') {
            $currency = $service->quoteCurrency();
            $amountWithFee = $service->buyAmountWithFee();
            $amount = $service->amount();
        } elseif ($type === 'sell') {
            $currency = $service->baseCurrency();
            $amountWithFee = $service->sellAmountWithFee();
            $amount = $service->quantity();
        }
        $user = User::find(Auth::user()->id);

        $currentWallet = $user->wallets()
            ->where('curr', $currency)
            ->firstOrFail();
        $balance = (float) $currentWallet->balance;

        // if (!$service->checkBalance($balance, $amountWithFee)) {
        //     return response()->json(['error' => $service->getErrors()], 422);
        // }

        $service->createTradingPair();
        $service->store();

        if ($service->fail()) {
            return response()->json(['error' => $service->getErrors()], 422);
        };
        $currentWallet->balance = $balance - $amountWithFee;
        $currentWallet->save();


        Transaction::create([
            'user_id' => $user->id,
            'order_id' => $service->currentOrder()->id,
            'type' => $type,
            'currency_pair' => $service->currencyPair(),
            'base_currency' => $service->baseCurrency(),
            'quote_currency' => $service->quoteCurrency(),
            'amount' => $amount,
            'fee' => $service->calculateFee($amount),
            'total' => $amountWithFee,
            'status' => 'paid',
        ]);

        $service->matchOrders($service->currentOrder());


        return $service->success();
    }
}
