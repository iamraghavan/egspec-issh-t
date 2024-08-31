<?php

use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\CheckAuth;
use App\Http\Middleware\CountryCodeMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\VerifyToken;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(RedirectIfAuthenticated::class);
        // $middleware->append(AdminAuth::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
