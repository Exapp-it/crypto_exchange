<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Order;
use App\Models\TradingPair;
use App\Models\User;
use App\Services\OrderService;
use Auth;
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
        $service = OrderService::init($request->all());
        $service->type('sell');


        if (!$service->validate()) {
            return response()->json(['error' => $service->getErrors()], 422);
        }

        $user = User::find(Auth::user()->id);
        $currentWallet = $user->wallets()->where('curr', $service->currencyTo())->firstOrFail();

        if (!$service->checkBalance($currentWallet->balance)) {
            return response()->json(['error' => $service->getErrors()], 422);
        }

        TradingPair::firstOrCreate([
            'name' =>  $service->currencyPair()
        ]);

        $service->store();

        if ($service->fail()) {
            return response()->json(['error' => $service->getErrors()], 422);
        }

        return $service->success();
    }


    public function buyProcess(Request $request)
    {
        $service = OrderService::init($request->all());
        $service->type('buy');


        if (!$service->validate()) {
            return response()->json(['error' => $service->getErrors()], 422);
        }

        $user = User::find(Auth::user()->id);
        $currentWallet = $user->wallets()->where('curr', $service->currencyTo())->firstOrFail();

        if (!$service->checkBalance($currentWallet->balance)) {
            return response()->json(['error' => $service->getErrors()], 422);
        }

        TradingPair::firstOrCreate([
            'name' =>  $service->currencyPair()
        ]);

        $service->store();

        if ($service->fail()) {
            return response()->json(['error' => $service->getErrors()], 422);
        }

        return $service->success();
    }


    function buyOrders(Request $request)
    {
        $orders = Order::where('user_id', $request->user()->id)
            ->where('type', 'buy')
            ->orderBy('created_at', 'DESC')
            ->get();

        return Response::json($orders);
    }
}
