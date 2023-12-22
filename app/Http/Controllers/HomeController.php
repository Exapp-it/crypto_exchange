<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index', [
            'currencies' => Currency::all(),
        ]);
    }

    public function about()
    {
        return view('home.about');
    }

    public function captureRefCode($code)
    {
        if (User::where('ref_code', $code)->exists()) {
            Session::put('ref_code', $code);
        }

        return Redirect::route('home');
    }
}
