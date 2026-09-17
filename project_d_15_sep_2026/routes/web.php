<?php

use App\Http\Controllers\Web\V1\HomeController;
use App\Http\Controllers\Web\V1\User\Auth\AuthController;
use App\Http\Controllers\Web\V1\User\DashboardController;
use App\Http\Controllers\Web\V1\User\UserUpdateController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('home', [HomeController::class, 'index'])
    ->name('users.home');

Route::get('login', [AuthController::class,'login'])->name('login');
Route::post('logout', [AuthController::class,'logout'])->name('logout');
Route::get('logout', [AuthController::class,'logout'])->name('logout');
Route::get('users/login', [AuthController::class,'login'])->name('users.login');

Route::post('users/login', [AuthController::class,'loginSubmit'])->name('users.login.submit');

Route::get('users/register', [AuthController::class,'register'])->name('users.register');

Route::post('users/register', [ AuthController::class, 'registerSubmit'])->name('users.register.submit');

Route::get('users/dashboard', [DashboardController::class, 'index'])->name('users.dashboard');


Route::view('contact', 'contact')->name('contact');
Route::view('about', 'about')->name('about');
Route::view('careers', 'careers')->name('careers');
Route::view('terms', 'terms')->name('terms');
Route::view('privacy', 'privacy')->name('privacy');