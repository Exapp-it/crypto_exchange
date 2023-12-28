<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\User\MainController;

Route::middleware('auth')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('', [MainController::class, 'index'])
            ->name('user');

        Route::get('wallets', [MainController::class, 'wallets'])
            ->name('user.wallets');
    });

    Route::prefix('order')->group(function () {
        Route::get('', [OrderController::class, 'index'])
            ->name('order');

        Route::get('buy', [OrderController::class, 'buy'])
            ->name('order.buy');

        Route::post('buy-process', [OrderController::class, 'buyProcess'])
            ->name('order.buy.process');

        Route::post('buy-orders', [OrderController::class, 'buyOrders'])
            ->name('order.buy.orders');

        Route::get('sell', [OrderController::class, 'sell'])
            ->name('order.sell');

        Route::post('sell-process', [OrderController::class, 'sellProcess'])
            ->name('order.sell.process');
    });

    Route::post('logout', [LoginController::class, 'logout'])->name('auth.logout');
});
