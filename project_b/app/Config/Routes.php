<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->get('/', 'Home::index');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| Admin Authentication
|--------------------------------------------------------------------------
|
*/

$namespaceWebV1 = 'Web\V1';
$namespaceApiV1 = 'Api\V1';
$namespaceAdminV1 = 'Web\V1\Admin';

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
$routes->group('admin', ['filter' => 'adminauth'], static function ($routes) use ($namespaceWebV1) {
    // Dashboard
    $routes->get('index', $namespaceWebV1.'\UserDashboardController::index');
    $routes->match(['get','post'],'profile',$namespaceWebV1.'\UserDashboardController::profile');

    $routes->get('users/register',$namespaceWebV1.'\UserRegisterController::signUp');
    $routes->post('users/register',$namespaceWebV1.'\UserRegisterController::signUpSubmit');

    // Seeder
    $routes->match([
        'get',
        'post'
    ],
    'seeder', $namespaceWebV1.'\UserDashboardController::insertDummyData');

    $routes->match(['get','post'], 'profile/update/(:any)' ,$namespaceWebV1.'\UserUpdateController::update/$1');

    $routes->match(['get','post'], 'users/profile/update/(:any)', $namespaceWebV1.'\UserUpdateController::update/$1');

    $routes->match(['get','post'], 'users/delete/(:any)',$namespaceWebV1.'\UserDeleteController::delete/$1');

    $routes->post(
        'users/delete/all',
        $namespaceWebV1 . '\UserDeleteController::deleteAll'
    );


    // Assignment list
    $routes->get(
        'assignments',
        $namespaceWebV1 . '\Admin\AssignmentController::index'
    );

    // Assignment Create
    $routes->match(
        ['get', 'post'],
        'assignments/create',
        $namespaceWebV1 . '\Admin\AssignmentController::create'
    );

    // Assignment Edit
    $routes->match(
        ['get', 'post'],
        'assignments/edit/(:num)',
        $namespaceWebV1 . '\Admin\AssignmentController::edit/$1'
    );

    // Assignment Delete
    $routes->post(
        'assignments/delete/(:num)',
        $namespaceWebV1 . '\Admin\AssignmentController::delete/$1'
    );
});

$routes->group('users', ['filter' => 'auth'], static function ($routes) use ($namespaceWebV1) {
    $routes->match(['get','post'],'dashboard',$namespaceWebV1.'\UserDashboardController::dashboard');
    $routes->match(['get','post'],'profile',$namespaceWebV1.'\UserDashboardController::profile');

    $routes->match(['get','post'],'profile/update/(:any)',$namespaceWebV1.'\UserUpdateController::update/$1');
});

// $routes->match(['get','post'],'/sign_in',$namespaceWebV1.'\UserLoginController::signIn');

$routes->match(['get','post'],'/',$namespaceWebV1.'\UserLoginController::signIn');
$routes->match(['get','post'], 'users/register',$namespaceWebV1.'\UserRegisterController::signUp');
$routes->match(['get','post'],'users/login',$namespaceWebV1.'\UserLoginController::signIn');
$routes->match(['get','post'],'/logout',$namespaceWebV1.'\UserLoginController::logout');
$routes->match(['get','post'],'users/logout',$namespaceWebV1.'\UserLoginController::logout');

$routes->match(['get','post'], '/register',$namespaceWebV1.'\UserRegisterController::registration');
$routes->match(['get','post'], '/update/(:any)',$namespaceWebV1.'\UserUpdateController::update/$1',['filter' => 'auth']);
$routes->match(['get','post'], '/terms',$namespaceWebV1.'\UserDashboardController::terms',['filter' => 'auth']);

/*
|--------------------------------------------------------------------------
| Admin APIs
|--------------------------------------------------------------------------
*/

$routes->post('/api/v1/admin/register', $namespaceApiV1.'\Auth\AuthController::register');
