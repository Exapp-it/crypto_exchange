<?php

namespace App\Services;


use App\Models\User;
use Carbon\Carbon;

class StatisticService
{

    public function getUserCount(): mixed
    {
        return User::count();
    }


    public function getUserCountToday(): mixed
    {
        return User::whereDate('created_at', Carbon::today())->count();
    }


    // public function getMerchantsCount(): mixed
    // {
    //     return Merchant::count();
    // }


    // public function getMerchantsCountToday(): mixed
    // {
    //     return Merchant::whereDate('created_at', Carbon::today())->count();
    // }


    // public function getApprovedPaymentsSum(): mixed
    // {
    //     return Payment::where('approved', true)->sum('amount_default_currency');
    // }


    // public function getApprovedPaymentsSumToday(): mixed
    // {
    //     return Payment::where('approved', true)->whereDate('created_at', Carbon::today())->sum('amount_default_currency');
    // }


    // public function getApprovedPaymentsSumLast7Days(): mixed
    // {
    //     return Payment::where('approved', true)
    //         ->whereBetween('created_at', [Carbon::today()->subDays(6), Carbon::today()])
    //         ->sum('amount_default_currency');
    // }


    // public function getApprovedPaymentsSumThisMonth(): mixed
    // {
    //     return Payment::where('approved', true)
    //         ->whereMonth('created_at', Carbon::today()->month)
    //         ->sum('amount_default_currency');
    // }


    // public function getApprovedWithdrawalsSum(): mixed
    // {
    //     return Withdrawal::where('approved', true)->sum('amount_default_currency');
    // }


    // public function getApprovedWithdrawalsSumToday(): mixed
    // {
    //     return Withdrawal::where('approved', true)->whereDate('created_at', Carbon::today())->sum('amount_default_currency');
    // }


    // public function getApprovedWithdrawalsSumLast7Days(): mixed
    // {
    //     return Withdrawal::where('approved', true)
    //         ->whereBetween('created_at', [Carbon::today()->subDays(6), Carbon::today()])
    //         ->sum('amount_default_currency');
    // }


    // public function getApprovedWithdrawalsSumThisMonth(): mixed
    // {
    //     return Withdrawal::where('approved', true)
    //         ->whereMonth('created_at', Carbon::today()->month)
    //         ->sum('amount_default_currency');
    // }
}
