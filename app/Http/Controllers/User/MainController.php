<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Auth;

class MainController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function wallets()
    {
        $user = Auth::user();
        $wallets = $user->wallets()->paginate(10);

        return view('user.wallets', [
            'wallets' => $wallets,
        ]);
    }
}
