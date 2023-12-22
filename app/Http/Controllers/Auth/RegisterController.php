<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Register;
use Telegram;

class RegisterController extends Controller
{

    public function store(Request $request)
    {
        Register::init($request->all());

        if (!Register::validate()) {
            return response()->json(['error' => Register::getErrors()], 422);
        }

        Register::store();

        if (Register::fail()) {
            return response()->json(['error' => Register::getErrors()], 422);
        }

        Register::createBalance();
        Register::welcomeMailNotify();
        Telegram::init();

        $message = __('Register new user') . PHP_EOL .
            __('Email') . ': ' . Register::user()->email;

        Telegram::sendMessage($message);
        return Register::responseSuccess();
    }
}
