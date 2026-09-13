<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$namespaceAdminV1 = 'Web\V1\Admin';

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/
$routes->group('admin', static function ($routes) use ($namespaceAdminV1) {
    $routes->get('/', $namespaceAdminV1.'\Auth\AuthController::login');
    $routes->get('login', $namespaceAdminV1.'\Auth\AuthController::index');
    $routes->post('login/submit', $namespaceAdminV1.'\Auth\AuthController::loginSubmit');

    $routes->get('logout', $namespaceAdminV1.'\Auth\AuthController::logout');
});

/*
|--------------------------------------------------------------------------
| Protected Admin Routes
|--------------------------------------------------------------------------
*/
$routes->group('admin', ['filter' => 'adminauth'], static function ($routes) use ($namespaceWebV1, $namespaceAdminV1) {
    // Dashboard
    $routes->get('index', $namespaceAdminV1.'\DashboardController::index');
    $routes->match(['get','post'],'profile',$namespaceAdminV1.'\DashboardController::profile');

    // Seeder
    $routes->match([
        'get',
        'post'
    ],
    'seeder', $namespaceAdminV1.'\DashboardController::insertDummyData');

    $routes->get('users/register',$namespaceWebV1.'\UserRegisterController::signUp');
    $routes->post('users/register',$namespaceWebV1.'\UserRegisterController::signUpSubmit');

    $routes->match(['get','post'], 'profile/update/(:any)' ,$namespaceWebV1.'\UserUpdateController::update/$1');

    $routes->match(['get','post'], 'users/profile/update/(:any)', $namespaceWebV1.'\UserUpdateController::update/$1');

    // Delete users data
    $routes->match(
        ['get','post'],
        'users/delete/(:any)',
        $namespaceAdminV1.'\UserDeleteController::delete/$1'
    );

    // $routes->post(
    //     'users/delete/all',
    //     $namespaceAdminV1 . '\UserDeleteController::deleteAll'
    // );

    // Assignment list
    $routes->get(
        'assignments',
        $namespaceAdminV1 . '\AssignmentController::index'
    );

    // Assignment Create
    $routes->match(
        ['get', 'post'],
        'assignments/create',
        $namespaceAdminV1 . '\AssignmentController::create'
    );

    // Assignment Edit
    $routes->match(
        ['get', 'post'],
        'assignments/edit/(:num)',
        $namespaceAdminV1 . '\AssignmentController::edit/$1'
    );

    // Assignment Delete
    $routes->post(
        'assignments/delete/(:num)',
        $namespaceAdminV1 . '\AssignmentController::delete/$1'
    );
});

// Delete All Selected Users Data
$routes->post(
    'users/delete/all',
    $namespaceAdminV1 . '\UserDeleteController::deleteAll'
);