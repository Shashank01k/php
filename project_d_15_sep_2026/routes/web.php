<?php

use App\Http\Controllers\Web\V1\Admin\Auth\AuthController;
use App\Http\Controllers\Web\V1\Admin\DashboardController;
use App\Http\Controllers\Web\V1\Admin\ProfileController;
use App\Http\Controllers\Web\V1\Admin\SeederController;
use App\Http\Controllers\Web\V1\Admin\UserRegisterController;
use App\Http\Controllers\Web\V1\HomeController;
use App\Http\Controllers\Web\V1\User\UserUpdateController;
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

        Route::get('seeder', [SeederController::class, 'index'])
            ->name('seeder.index');

        Route::post('/seeder', [SeederController::class, 'insertDummyData'])
            ->name('seeder.store');

        Route::get('/profile', [DashboardController::class, 'profile'])
            ->name('profile');

        Route::get('users/profile/update/{userId}', [UserUpdateController::class, 'edit'])
            ->name('users.profile.edit');

        Route::post('users/profile/update/{userId}', [UserUpdateController::class, 'update'])
            ->name('users.profile.update');

        Route::get('profile/update/{userId}', [ProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::post('profile/update/{userId}', [ProfileController::class, 'update'])
            ->name('profile.update');
});

Route::view('/contact', 'contact')->name('contact');

Route::view('/about', 'about')->name('about');

Route::view('/careers', 'careers')->name('careers');

Route::view('/terms', 'terms')->name('terms');

Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/dashboard', 'dashboard')->name('dashboard');
Route::view('/sign_up', 'sign_up')->name('sign_up');
Route::view('/profile', 'profile')->name('profile');