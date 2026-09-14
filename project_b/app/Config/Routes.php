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

$namespaceWebV1 = 'Web\V1';

$routes->group('users', ['filter' => 'auth'], static function ($routes) use ($namespaceWebV1) {
    $routes->match(['get','post'],'dashboard',$namespaceWebV1.'\UserDashboardController::dashboard');
    $routes->match(['get','post'],'profile',$namespaceWebV1.'\UserDashboardController::profile');

    $routes->match(['get','post'],'profile/update/(:any)',$namespaceWebV1.'\UserUpdateController::update/$1');

    $routes->get(
        'assignments',
        $namespaceWebV1 . '\UserAssignmentController::index'
    );

    $routes->get(
        'assignments/view/(:num)',
        $namespaceWebV1 . '\UserAssignmentController::view/$1'
    );
});

$routes->get('users/register',$namespaceWebV1.'\UserRegisterController::signUp');
$routes->post('users/register',$namespaceWebV1.'\UserRegisterController::signUpSubmit');

$routes->match(['get','post'],'/login',$namespaceWebV1.'\UserLoginController::signIn');
$routes->match(['get','post'],'users/login',$namespaceWebV1.'\UserLoginController::signIn');

$routes->match(['get','post'],'/logout',$namespaceWebV1.'\UserLoginController::logout');
$routes->match(['get','post'],'users/logout',$namespaceWebV1.'\UserLoginController::logout');

// $routes->match(['get','post'], '/update/(:any)',$namespaceWebV1.'\UserUpdateController::update/$1',['filter' => 'auth']);
$routes->match(['get','post'], '/terms',$namespaceWebV1.'\UserDashboardController::terms',['filter' => 'auth']);

$routes->get('csrf-token', static function () {
    return service('response')->setJSON([
        'csrfTokenName' => csrf_token(),
        'csrfHash'     => csrf_hash(),
    ]);
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| Admin Authentication
|--------------------------------------------------------------------------
|
*/
require APPPATH . 'Config/Routes/Admin.php';


/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
|
*/
require APPPATH . 'Config/Routes/Api.php';

$routes->post('users/create', $namespaceWebV1.'\UserRegisterController::test');
