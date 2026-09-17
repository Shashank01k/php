<?php

use App\Http\Middleware\AdminAuthMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__ .'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',

        then: function () {
            $routes = [
                'admin.php',
            ];

            foreach ($routes as $route) {
                require base_path('routes/' . $route);
            }
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'adminAuth' => AdminAuthMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
