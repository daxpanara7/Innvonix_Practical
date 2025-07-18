<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use App\Http\Middleware\AdminMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        
        // Register middleware aliases (used in route middleware)
        $middleware->alias([
            'auth:sanctum' => EnsureFrontendRequestsAreStateful::class,
            'admin' => AdminMiddleware::class, // ✅ register custom admin middleware
        ]);

        // Optionally add global middleware if needed using:
        // $middleware->append(SomeGlobalMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Customize exception handling if needed
    })->create();
