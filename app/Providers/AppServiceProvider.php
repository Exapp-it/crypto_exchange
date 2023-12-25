<?php

namespace App\Providers;

use App\Bots\Telegram;
use App\Services\Auth\LoginService;
use App\Services\Auth\RegisterService;
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
        $this->app->bind('login-service', function () {
            return new LoginService();
        });
        $this->app->bind('register-service', function () {
            return new RegisterService();
        });
        $this->app->bind('wallet-service', function () {
            return new WalletService();
        });
        $this->app->bind('telegram', function () {
            return new Telegram();
        });
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
