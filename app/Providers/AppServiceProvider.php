<?php

namespace App\Providers;

use App\Bots\Telegram;
use App\Services\Auth\LoginService;
use App\Services\Auth\RegisterService;
use App\Services\OrderService;
use App\Services\WalletService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $view->with('user', Auth::user());
            }
        });
    }
}
