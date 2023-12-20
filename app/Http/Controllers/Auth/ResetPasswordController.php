<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{

    public function index(Request $request, $token = null)
    {
        return view('auth.reset')->with(
            ['token' => $token, 'email' => $request->get('email')]
        );
    }

    public function reset(Request $request)
    {
        $validator = Validator::make([
            'token' => $request->post('token'),
            'email' => $request->post('email'),
            'password' => $request->post('password'),
            'password_confirmation' => $request->post('password_confirmation'),
        ], [
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->toArray()], 422);
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['message' => __('Reset password successful'), 'status' => 'success',], 200)
            : response()->json(['error' => __($status)], 422);
    }
}
