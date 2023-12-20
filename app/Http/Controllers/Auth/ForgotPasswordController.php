<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{

    public function sendResetLinkEmail(Request $request)
    {

        $validator = Validator::make([
            'email' => $request->post('email'),
        ], [
            'email' => ['required', 'email']
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->toArray()], 422);
        }

        $check = User::where('email', $request->post('email'))->exists();

        if (!$check) {
            return response()->json(['error' => __('Not email')], 422);
        }

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => __('Send link successful'), 'status' => 'success'], 200)
            : response()->json(['error' => __($status)], 422);
    }
}
