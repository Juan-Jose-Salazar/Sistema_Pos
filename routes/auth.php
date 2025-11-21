<?php


use App\Http\Controllers\AccountController;
use App\Models\User;

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::get('register', [AccountController::class, 'register'])
        ->name('account.register');

    Route::post('register', [AccountController::class, 'registerPost']);

    Route::get('login', [AccountController::class, 'login'])
        ->name('login');

    Route::post('login', [AccountController::class, 'loginPost']);
/*
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
        */
});

Route::middleware('auth')->group(function () {

    Route::post('logout', [AccountController::class, 'logout'])
        ->name('account.logout');
});
