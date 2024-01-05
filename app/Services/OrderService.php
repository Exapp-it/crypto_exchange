<?php

namespace App\Services;

use App\Models\Order;
use App\Models\TradingPair;
use App\Models\Transaction;
use Auth;
use DB;
use Log;
use Response;
use Validator;

class OrderService
{
    protected const RULES = [
        'quantity' => ['required', 'numeric', 'min:0'],
        'base_currency' => ['required'],
        'price' => ['required', 'numeric', 'min:0'],
        'quote_currency' => ['required'],
    ];

    protected string $quantity = '';
    protected string $base_currency = '';
    protected string $price = '';
    protected string $quote_currency = '';
    protected string $Amount = '';
    protected string $type = '';
    protected ?Order $order;

    protected array $errors = [];
    protected bool $fail = false;

    public function __construct(array $data)
    {
        $this->quantity = $data['quantity'] ?? '';
        $this->base_currency = $data['base_currency'] ?? '';
        $this->price = $data['price'] ?? '';
        $this->quote_currency = $data['quote_currency'] ?? '';
    }

    public static function init(array $data): static
    {
        return new static($data);
    }

    public function validate(): bool
    {
        $validator = Validator::make([
            'quantity' => $this->quantity,
            'base_currency' => $this->base_currency,
            'price' => $this->price,
            'quote_currency' => $this->quote_currency,
        ], static::RULES);

        if ($validator->fails()) {
            $this->errors = $validator->errors()->toArray();
            return false;
        }
        return true;
    }

    public function store(): void
    {
        try {
            DB::beginTransaction();

            if ($this->type() === 'buy') {
                $amount = $this->amount();
                $amountWithFee = $this->buyAmountWithFee();
            } elseif ($this->type() === 'sell') {
                $amount = $this->quantity();
                $amountWithFee = $this->sellAmountWithFee();
            }

            $this->order = Order::create([
                'user_id' => Auth::user()->id,
                'type' => $this->type(),
                'currency_pair' => $this->currencyPair(),
                'price' => $this->price,
                'quantity' => $this->quantity,
                'amount' => $amount,
                'fee' => $this->calculateFee($amount),
                'total' => $amountWithFee,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->fail = true;
            Log::error(__('Error while creating order: ') . $e->getMessage());
            $this->errors = [__('Order error')];
            throw new \Exception($e->getMessage());
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function fail(): bool
    {
        return $this->fail;
    }

    public function success()
    {
        return Response::json([
            'message' => __('Order successful created'),
            'status' => 'success',
        ], 200);
    }

    public function quantity()
    {
        return $this->quantity;
    }

    public function currencyPair()
    {
        return $this->base_currency . '/' . $this->quote_currency;
    }

    public function buyAmountWithFee()
    {
        return $this->Amount() + $this->calculateFee($this->Amount());
    }

    public function sellAmountWithFee()
    {
        return $this->quantity() + $this->calculateFee($this->quantity());
    }

    public function amount()
    {
        return $this->quantity() * $this->price;
    }

    public function type($type = '')
    {
        return $type ? $this->type = $type : $this->type;
    }

    public function calculateFee($amount)
    {
        $fee = 0.03;
        return $amount * $fee;
    }

    public function baseCurrency()
    {
        return $this->base_currency;
    }

    public function quoteCurrency()
    {
        return $this->quote_currency;
    }


    public function createTradingPair()
    {
        TradingPair::firstOrCreate([
            'name' => $this->currencyPair(),
            'base_currency' => $this->baseCurrency(),
            'quote_currency' => $this->quoteCurrency(),
        ]);
    }

    public function checkBalance($balance, $amount)
    {
        if ((float) $balance < $amount) {
            $this->errors = ['error' => __('Insufficient funds on your account')];
            return false;
        }
        return true;
    }

    public function currentOrder()
    {
        return $this->order;
    }

    public function matchOrders($order)
    {
        try {
            DB::beginTransaction();

            $matchingOrders = Order::where('type', '!=', $order->type)
                ->where('user_id', '!=', $order->user_id)
                ->where('currency_pair', $order->currency_pair)
                ->where('status', 'open')
                ->where('price', '<=', $order->price)
                ->orderBy('created_at', 'asc')
                ->get();


            if ($matchingOrders) {
                foreach ($matchingOrders as $matchingOrder) {
                    $matchedQuantity = min($matchingOrder->quantity, $order->quantity);
                    [$baseCurrency, $quoteCurrency] = explode('/', $matchingOrder->currency_pair);
                    // $order->quantity -= $matchedQuantity;
                    // $order->save();
                    // $order->refresh();


                    $matchingOrderUserWallet = $matchingOrder->user->wallets->where('curr', $this->type() === 'sell' ? $baseCurrency : $quoteCurrency)->first();
                    // $matchingOrderUserWallet->balance += $matchedQuantity * $order->price;
                    // $matchingOrderUserWallet->save();

                    $orderUserWallet =  $order->user->wallets->where('curr', $this->type() === 'sell' ? $baseCurrency : $quoteCurrency)->first();
                    // $orderUserWallet->balance += $matchedQuantity;
                    // $orderUserWallet->save();

                    dd($orderUserWallet->curr);



                    // // Проверяем, нужно ли закрыть $matchingOrder
                    // if ($matchedQuantity >= $matchingOrder->quantity) {
                    //     $matchingOrder->quantity -= $matchedQuantity;
                    //     $matchingOrder->status = 'closed';
                    //     $matchingOrder->save();
                    //     $matchingOrder->refresh();
                    // } else {
                    //     $matchingOrder->quantity -= $matchedQuantity;
                    //     $matchingOrder->save();
                    //     $matchingOrder->refresh();
                    // }

                    // Transaction::create([
                    //     'user_id' => $matchingOrder->user_id,
                    //     'order_id' => $matchingOrder->id,
                    //     'type' => $matchingOrder->type,
                    //     'currency_pair' => $matchingOrder->currency_pair,
                    //     'base_currency' => $baseCurrency,
                    //     'quote_currency' => $quoteCurrency,
                    //     'amount' => $matchedQuantity,
                    //     'fee' => $this->calculateFee($matchedQuantity),
                    //     'total' => $matchingOrder->amount,
                    //     'status' => 'success',
                    // ]);

                    if ($order->quantity <= 0) {
                        $order->status = 'closed';
                        $order->save();
                        // Завершаем цикл, если заказ полностью сопоставлен
                        break;
                    }
                }

                DB::commit();

                return Response::json([
                    'message' => __('Orders successfully matched'),
                    'status' => 'success',
                ], 200);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return Response::json([
                'error' => __('Error during order matching'),
                'status' => 'error',
            ], 500);
        }
    }
}
