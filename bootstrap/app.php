<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\Admin::class,
            'userMiddleware' => \App\Http\Middleware\UserMiddleware::class,
            'RedirectToCheckout' => \App\Http\Middleware\RedirectToCheckout::class,
            'NoBack' => \App\Http\Middleware\NobackMiddleware::class,
            'setLanguage' => \App\Http\Middleware\SetLanguage::class,
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);

        $middleware->validateCsrfTokens(except: [
            '/pay-via-ajax', '/success', '/cancel', '/fail', '/ipn'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
