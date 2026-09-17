<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\V1\Admin\Auth\AuthController;
use App\Http\Controllers\Web\V1\Admin\DashboardController;
use App\Http\Controllers\Web\V1\Admin\SeederController;
use App\Http\Controllers\Web\V1\Admin\AssignmentController;
use App\Http\Controllers\Web\V1\Admin\UserRegisterController;
use App\Http\Controllers\Web\V1\User\UserUpdateController;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware('web')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Admin Authentication
        |--------------------------------------------------------------------------
        */

        Route::get('/login', [
            AuthController::class,
            'index'
        ])->name('login');

        Route::post('/login/submit', [
            AuthController::class,
            'loginSubmit'
        ])->name('login.submit');

        Route::post('/logout', [
            AuthController::class,
            'logout'
        ])->name('logout');

        Route::get('/logout', [
            AuthController::class,
            'logout'
        ])->name('logout');


        /*
        |--------------------------------------------------------------------------
        | Protected Admin Routes
        |--------------------------------------------------------------------------
        */

        Route::middleware('adminAuth')->group(function () {

            /*
            |--------------------------------------------------------------------------
            | Dashboard
            |--------------------------------------------------------------------------
            */

            Route::get('/index', [
                DashboardController::class,
                'index'
            ])->name('dashboard.index');


            /*
            |--------------------------------------------------------------------------
            | Admin Profile
            |--------------------------------------------------------------------------
            */

            Route::get('/profile', [
                DashboardController::class,
                'profile'
            ])->name('profile');


            /*
            |--------------------------------------------------------------------------
            | User Registration
            |--------------------------------------------------------------------------
            */

            Route::get('/users/register', [
                UserRegisterController::class,
                'create'
            ])->name('users.register');

            Route::post('/users/register', [
                UserRegisterController::class,
                'add'
            ])->name('users.register.store');


            /*
            |--------------------------------------------------------------------------
            | Seeder
            |--------------------------------------------------------------------------
            */

            Route::get('/seeder', [
                SeederController::class,
                'index'
            ])->name('seeder.index');

            Route::post('/seeder', [
                SeederController::class,
                'insertDummyData'
            ])->name('seeder.store');


            /*
            |--------------------------------------------------------------------------
            | Assignments
            |--------------------------------------------------------------------------
            */

            Route::get('/assignments', [
                AssignmentController::class,
                'index'
            ])->name('assignments.index');

            Route::get('/assignments/create', [
                AssignmentController::class,
                'create'
            ])->name('assignments.create.form');

            Route::post('/assignments/create', [
                AssignmentController::class,
                'store'
            ])->name('assignments.create');

            Route::get('/assignments/{id}/edit', [
                AssignmentController::class,
                'edit'
            ])->name('assignments.edit');

            Route::put('/assignments/{id}', [
                AssignmentController::class,
                'update'
            ])->name('assignments.update');

            Route::delete('/assignments/{id}', [
                AssignmentController::class,
                'destroy'
            ])->name('assignments.destroy');


            /*
            |--------------------------------------------------------------------------
            | Admin Profile Update
            |--------------------------------------------------------------------------
            */

            Route::get('/profile/update/{userId}', [
                UserUpdateController::class,
                'edit'
            ])->name('profile.edit');

            Route::post('/profile/update/{userId}', [
                UserUpdateController::class,
                'update'
            ])->name('profile.update');


            /*
            |--------------------------------------------------------------------------
            | Admin Updating Another User
            |--------------------------------------------------------------------------
            */

            Route::get('/users/profile/update/{userId}', [
                UserUpdateController::class,
                'edit'
            ])->name('users.profile.edit');

            Route::post('/users/profile/update/{userId}', [
                UserUpdateController::class,
                'update'
            ])->name('users.profile.update');

        });

    });