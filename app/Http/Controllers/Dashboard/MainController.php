<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }
}
