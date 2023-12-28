<?php

namespace App\Http\Controllers\Auth;

use App\Bots\Telegram;
use App\Http\Controllers\Controller;
use App\Services\Auth\RegisterService;
use App\Services\WalletService;
use Illuminate\Http\Request;


class RegisterController extends Controller
{

    public function store(Request $request)
    {
        $service = RegisterService::init($request->all());

        if (!$service->validate()) {
            return response()->json(['error' => $service->getErrors()], 422);
        }

        $service->store();

        if ($service->fail()) {
            return response()->json(['error' => $service->getErrors()], 422);
        }

        WalletService::create($service->user());
        $service->welcomeMailNotify();
        $bot = Telegram::init();

        $message = __('Register new user') . PHP_EOL .
            __('Email') . ': ' . $service->user()->email;

        $bot->sendMessage($message);
        return $service->responseSuccess();
    }
}
