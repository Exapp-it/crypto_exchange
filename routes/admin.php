<?php

use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MainController;
use Illuminate\Support\Facades\Route;


Route::middleware('admin.auth')->group(function () {
    Route::get('/', [MainController::class, 'index'])
        ->name('admin');

    Route::get('users', [MainController::class, 'users'])
        ->name('admin.users');

    Route::get('{id}/transaction', [MainController::class, 'transaction'])
        ->name('admin.transaction');

    Route::get('logout', [LoginController::class, 'destroy'])
        ->name('admin.logout');

    Route::prefix('currencies')->group(function () {
        Route::get('/', [CurrencyController::class, 'index'])
            ->name('admin.currencies');

        Route::get('create', [CurrencyController::class, 'create'])
            ->name('admin.currencies.create');

        Route::post('store', [CurrencyController::class, 'store'])
            ->name('admin.currencies.store');

        Route::post('change-status/{id}', [CurrencyController::class, 'changeStatus'])
            ->name('admin.currencies.status');

        Route::post('destroy/{id}', [CurrencyController::class, 'destroy'])
            ->name('admin.currencies.destroy');
    });
});

Route::middleware('guest:admin')->group(function () {
    Route::get('login', [LoginController::class, 'index'])
        ->name('admin.login');

    Route::post('login', [LoginController::class, 'store'])
        ->name('admin.login.store');
});
