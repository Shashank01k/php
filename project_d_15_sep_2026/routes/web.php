<?php

use App\Http\Controllers\Web\V1\Admin\Auth\AuthController;
use App\Http\Controllers\Web\V1\Admin\DashboardController;
use App\Http\Controllers\Web\V1\Admin\UserRegisterController;
use App\Http\Controllers\Web\V1\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/home', [HomeController::class, 'index'])
    ->name('users.home');

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

    Route::get('/login', [AuthController::class, 'index'])
        ->name('login');

    Route::post('/login/submit', [AuthController::class, 'loginSubmit'])
        ->name('login.submit');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware('adminAuth')
    ->group(function () {

    Route::get('/index', [DashboardController::class, 'index'])
        ->name('dashboard.index');

    Route::get('users/register', ['App\\Http\\Controllers\\Web\\V1\\Admin\\UserRegisterController', 'create'])
        ->name('users.register');

    Route::post('users/register', ['App\\Http\\Controllers\\Web\\V1\\Admin\\UserRegisterController', 'add'])
        ->name('users.register.store');
});

Route::view('/contact', 'contact')->name('contact');

Route::view('/about', 'about')->name('about');

Route::view('/careers', 'careers')->name('careers');

Route::view('/terms', 'terms')->name('terms');

Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/dashboard', 'dashboard')->name('dashboard');
Route::view('/sign_up', 'sign_up')->name('sign_up');
Route::view('/profile', 'profile')->name('profile');