<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
//        6498877845
        return view('home.index');
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
