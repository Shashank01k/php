<?php

use App\Http\Controllers\Web\V1\HomeController;
use App\Http\Controllers\Web\V1\User\AssignmentController;
use App\Http\Controllers\Web\V1\User\Auth\AuthController;
use App\Http\Controllers\Web\V1\User\DashboardController;
use App\Http\Controllers\Web\V1\User\Profile\ProfileController;
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
Route::get('users/assignments', [AssignmentController::class, 'index'])->name('users.assignments');

Route::get('users/profile', [ProfileController::class, 'index'])->name('users.profile');
Route::get('users/profile/edit', [ProfileController::class, 'edit'])->name('users.profile.edit');
Route::post('users/profile/update', [ProfileController::class, 'update'])->name('users.profile.update');


Route::middleware('web')
    ->prefix('users')
    ->name('users.')
    // ->middleware('auth')
    ->group(function () {

        // Route::get('dashboard', [DashboardController::class, 'index'])
        //     ->name('dashboard');

        Route::get('/assignments', [
            AssignmentController::class,
            'index'
        ])->name('assignments.index');

        Route::get('/assignments/{id}', [
            AssignmentController::class,
            'show'
        ])->name('assignments.show');

        Route::post('/assignments/{id}/start', [
            AssignmentController::class,
            'start'
        ])->name('assignments.start');

});


Route::view('contact', 'contact')->name('contact');
Route::view('about', 'about')->name('about');
Route::view('careers', 'careers')->name('careers');
Route::view('terms', 'terms')->name('terms');
Route::view('privacy', 'privacy')->name('privacy');