<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$namespaceApiV1 = 'Api\V1';

/*
|--------------------------------------------------------------------------
| Admin APIs
|--------------------------------------------------------------------------
*/

$routes->post(
    'api/v1/admin/register',
    '\App\Controllers\Api\V1\Auth\AuthController::register'
);

$routes->post('api/validate-password',
    '\App\Controllers\Api\V1\Auth\AuthController::validatePassword'
);