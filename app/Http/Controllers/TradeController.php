<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class TradeController extends Controller
{
    public function index()
    {
        return view('trade.index');
    }

    public function buy()
    {
        return view('trade.buy');
    }

    public function sell()
    {
        $currencies = Currency::where('status', true)->get();

        return view('trade.sell', [
            'currencies' => $currencies,
        ]);
    }
}
