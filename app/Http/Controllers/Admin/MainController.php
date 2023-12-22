<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdrawal;
use App\Services\StatisticService;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class MainController extends Controller
{
    public function index()
    {
        $statisticService = new StatisticService();

        $statistics = (object)[
            'usersCount' => $statisticService->getUserCount(),
            'usersCountToday' => $statisticService->getUserCountToday(),
        ];

        return view('admin.index', ['statistics' => $statistics]);
    }


    public function users(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::query()->paginate(10);

        return view('admin.users', ['users' => $users]);
    }




    // public function transaction($id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    // {
    //     $transaction = Transaction::find($id);

    //     return view('admin.transaction', ['transaction' => $transaction]);
    // }
}
