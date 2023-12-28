<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\LoginService;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function store(Request $request): JsonResponse
    {
        $service = LoginService::init($request->all());

        if (!$service->validate()) {
            return response()->json(['error' => $service->getErrors()], 422);
        }

        $service->store();

        if ($service->fail()) {
            return response()->json(['error' => $service->getErrors()], 422);
        }

        return $service->responseSuccess();
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
