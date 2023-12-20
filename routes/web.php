<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Dashboard\MainController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('about', [HomeController::class, 'about'])->name('about');

Route::get('ref/{code}', [HomeController::class, 'captureRefCode'])->middleware('guest');


// Auth

Route::middleware('guest')->prefix('auth')->group(function () {
    Route::post('login', [LoginController::class, 'store'])->name('auth.login');
    Route::post('register', [RegisterController::class, 'store'])->name('auth.register');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'index'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('main', [MainController::class, 'index'])->name('main');
    Route::post('logout', [LoginController::class, 'logout'])->name('auth.logout');
});
