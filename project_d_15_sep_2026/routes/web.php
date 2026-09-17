<?php

use App\Http\Controllers\Web\V1\Admin\AssignmentController;
use App\Http\Controllers\Web\V1\Admin\Auth\AuthController;
use App\Http\Controllers\Web\V1\Admin\DashboardController;
use App\Http\Controllers\Web\V1\Admin\ProfileController;
use App\Http\Controllers\Web\V1\Admin\SeederController;
use App\Http\Controllers\Web\V1\Admin\UserRegisterController;
use App\Http\Controllers\Web\V1\HomeController;
use App\Http\Controllers\Web\V1\User\Auth\AuthController as AuthAuthController;
use App\Http\Controllers\Web\V1\User\UserUpdateController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/home', [HomeController::class, 'index'])
    ->name('users.home');

Route::get('/login', [
    AuthAuthController::class,
    'login'
])->name('login');

Route::post('/login', [
    AuthAuthController::class,
    'loginSubmit'
])->name('login.submit');

Route::get('/users/login', [
    AuthAuthController::class,
    'login'
])->name('users.login');

Route::post('/users/login', [
    AuthAuthController::class,
    'loginSubmit'
])->name('users.login.submit');

Route::get('/users/register', [
    AuthAuthController::class,
    'register'
])->name('users.register');

Route::post('/users/register', [
    AuthAuthController::class,
    'registerSubmit'
])->name('users.register');

Route::get('users/dashboard', [\App\Http\Controllers\Web\V1\User\DashboardController::class, 'index'])
            ->name('users.dashboard');
Route::get('dashboard', [\App\Http\Controllers\Web\V1\User\DashboardController::class, 'index'])
            ->name('dashboard');

Route::view('/contact', 'contact')->name('contact');

Route::view('/about', 'about')->name('about');

Route::view('/careers', 'careers')->name('careers');

Route::view('/terms', 'terms')->name('terms');

Route::view('/privacy', 'privacy')->name('privacy');
// Route::view('users/dashboard', 'index')->name('users.dashboard');
Route::view('/sign_up', 'sign_up')->name('sign_up');
Route::view('/profile', 'profile')->name('profile');