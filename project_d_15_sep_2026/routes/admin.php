<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\V1\Admin\Auth\AuthController;
use App\Http\Controllers\Web\V1\Admin\DashboardController;
use App\Http\Controllers\Web\V1\Admin\SeederController;
use App\Http\Controllers\Web\V1\Admin\AssignmentController;
use App\Http\Controllers\Web\V1\Admin\InterviewController;
use App\Http\Controllers\Web\V1\Admin\InterviewQuestionController;
use App\Http\Controllers\Web\V1\Admin\Users\UserController;
// use App\Http\Controllers\Web\V1\Admin\UserRegisterController;
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
                UserController::class,
                'create'
            ])->name('users.register');

            Route::post('/users/register', [
                UserController::class,
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

             /*
         * Interviews
         */
        Route::get('/interviews', [
            InterviewController::class,
            'index'
        ])->name('interviews.index');
        Route::get('/interviews/index', [
            InterviewController::class,
            'index'
        ])->name('interviews.index');

        Route::get('/interviews/create', [
            InterviewController::class,
            'create'
        ])->name('interviews.create');

        Route::post('/interviews', [
            InterviewController::class,
            'store'
        ])->name('interviews.store');

        Route::get('/interviews/{id}', [
            InterviewController::class,
            'show'
        ])->name('interviews.show');

        Route::get('/interviews/{id}/edit', [
            InterviewController::class,
            'edit'
        ])->name('interviews.edit');

        Route::put('/interviews/{id}', [
            InterviewController::class,
            'update'
        ])->name('interviews.update');

        Route::delete('/interviews/{id}', [
            InterviewController::class,
            'destroy'
        ])->name('interviews.destroy');


        /*
         * Interview Questions
         */
        Route::get('/interviews/{interviewId}/questions', [
            InterviewQuestionController::class,
            'index'
        ])->name('interviews.questions.index');

        Route::get('/interviews/{interviewId}/questions/create', [
            InterviewQuestionController::class,
            'create'
        ])->name('interviews.questions.create');

        Route::post('/interviews/{interviewId}/questions', [
            InterviewQuestionController::class,
            'store'
        ])->name('interviews.questions.store');

        Route::get('/interviews/{interviewId}/questions/{questionId}/edit', [
            InterviewQuestionController::class,
            'edit'
        ])->name('interviews.questions.edit');

        Route::put('/interviews/{interviewId}/questions/{questionId}', [
            InterviewQuestionController::class,
            'update'
        ])->name('interviews.questions.update');

        Route::delete('/interviews/{interviewId}/questions/{questionId}', [
            InterviewQuestionController::class,
            'destroy'
        ])->name('interviews.questions.destroy');

        });

    });