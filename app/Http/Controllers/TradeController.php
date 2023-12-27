<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Order;
use App\Models\TradingPair;
use Illuminate\Http\Request;
use Response;
use Validator;

class TradeController extends Controller
{
    public function index()
    {
        return view('trade.index');
    }

    public function buy()
    {
        $currencies = Currency::where('status', true)->get();

        return view('trade.buy', [
            'currencies' => $currencies,
        ]);
    }

    public function sell()
    {
        $currencies = Currency::where('status', true)->get();

        return view('trade.sell', [
            'currencies' => $currencies,
        ]);
    }

    public function sellProcess(Request $request)
    {
        $validator = Validator::make(
            [
                'quantity' => $request->post('quantity'),
                'from_currency' => $request->post('from_currency'),
                'price' => $request->post('price'),
                'to_currency' => $request->post('to_currency'),
            ],
            [
                'quantity' => ['required', 'numeric'],
                'from_currency' => ['required'],
                'price' => ['required', 'numeric'],
                'to_currency' => ['required'],
            ],
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $currencyPair = $request->post('from_currency') . '/' . $request->post('to_currency');
        $quantity = $request->post('quantity');
        $fee = 0.04;

        TradingPair::firstOrCreate(['name' =>  $currencyPair]);

        Order::create([
            'user_id' => $request->user()->id,
            'type' => 'sell',
            'currency_pair' => $currencyPair,
            'price' => $request->post('price'),
            'quantity' => formatCryptoAmount($quantity),
        ]);

        return response()->json([
            'message' => __('Order successful created'),
            'status' => 'success',
        ], 200);
    }

    public function buyProcess(Request $request)
    {
        $validator = Validator::make(
            [
                'quantity' => $request->post('quantity'),
                'from_currency' => $request->post('from_currency'),
                'price' => $request->post('price'),
                'to_currency' => $request->post('to_currency'),
            ],
            [
                'quantity' => ['required', 'numeric'],
                'from_currency' => ['required'],
                'price' => ['required', 'numeric'],
                'to_currency' => ['required'],
            ],
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $currencyPair = $request->post('from_currency') . '/' . $request->post('to_currency');
        $quantity = $request->post('quantity');
        $fee = 0.04;

        TradingPair::firstOrCreate(['name' =>  $currencyPair]);

        Order::create([
            'user_id' => $request->user()->id,
            'type' => 'buy',
            'currency_pair' => $currencyPair,
            'price' => $request->post('price'),
            'quantity' => formatCryptoAmount($quantity),
        ]);

        return response()->json([
            'message' => __('Order successful created'),
            'status' => 'success',
        ], 200);
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
