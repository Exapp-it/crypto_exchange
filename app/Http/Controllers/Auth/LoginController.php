<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Login;

class LoginController extends Controller
{

    public function store(Request $request): JsonResponse
    {
        Login::init($request->all());

        if (!Login::validate()) {
            return response()->json(['error' => Login::getErrors()], 422);
        }

        Login::store();

        if (Login::fail()) {
            return response()->json(['error' => Login::getErrors()], 422);
        }

        return Login::responseSuccess();
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
