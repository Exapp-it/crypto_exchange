<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\User\MainController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('about', [HomeController::class, 'about'])->name('about');

Route::get('ref/{code}', [HomeController::class, 'captureRefCode'])->middleware('guest');
Route::post('set-locale', function (Request $request) {
    $locale = $request->input('locale');

    if (in_array($locale, array_keys(languages()))) {
        Session::put('locale', $locale);
    }

    return redirect()->back();
})->name('set.locale');

Route::get('coin', function () {
    $url = 'https://sandbox-api.coinmarketcap.com/v1/cryptocurrency/info';
    $parameters = '';
    // [
    //     'start' => '1',
    //     'limit' => '5000',
    //     'convert' => 'USD',
    // ];

    $response = Http::withHeaders([
        'Accept' => 'application/json',
        'X-CMC_PRO_API_KEY' => '9cf83c9a-04f7-4f3c-9c59-01eda95d98ab',
    ])->get($url, $parameters);

    $data = $response->json(); // Получение данных в виде массива

    // Вывод данных для проверки
    dd($data);
});



// Auth

Route::middleware('guest')->prefix('auth')->group(function () {
    Route::post('login', [LoginController::class, 'store'])
        ->name('auth.login');

    Route::post('register', [RegisterController::class, 'store'])
        ->name('auth.register');

    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'index'])
        ->name('password.reset');

    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
        ->name('password.update');
});
