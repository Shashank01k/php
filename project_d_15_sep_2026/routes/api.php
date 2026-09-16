<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\PasswordController;

Route::prefix('v1')
    ->name('api.v1.')
    ->group(function () {

    Route::prefix('auth')
        ->name('auth.')->group(function () {

    Route::post('/validate-password', [PasswordController::class, 'validate'])
        ->name('validate.password');
    });

    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {

        Route::post('/register', [
            AuthController::class,
            'register'
        ])->name('register');

    });
});
