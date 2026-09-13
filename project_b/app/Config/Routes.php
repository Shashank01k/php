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
$routes->group('admin', static function ($routes) {
    $namespaceAdminV1 = 'Web\V1\Admin';

    $routes->match(['get','post'], 'login', $namespaceAdminV1.'\Auth\AuthController::login');
    $routes->match(['get','post'], 'login/submit', $namespaceAdminV1.'\Auth\AuthController::loginSubmit');

    $routes->get('/', $namespaceAdminV1.'\Auth\AuthController::login');
    $routes->get('logout', $namespaceAdminV1.'\Auth\AuthController::logout');
});

$namespaceWebV1 = 'Web\V1';
/*
|--------------------------------------------------------------------------
| Protected Admin Routes
|--------------------------------------------------------------------------
*/
$routes->group('admin', ['filter' => 'adminauth'], static function ($routes) use ($namespaceWebV1) {
    // dd('iopii');
    // Dashboard
    $routes->get('index', $namespaceWebV1.'\UserDashboardController::index');
    $routes->match(['get','post'],'profile',$namespaceWebV1.'\UserDashboardController::profile');

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
$namespaceApiV1 = 'Api\V1';

$routes->post('/api/v1/admin/register', $namespaceApiV1.'\Auth\AuthController::register');
