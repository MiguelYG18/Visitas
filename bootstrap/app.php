<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\VigilanteMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Database\QueryException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin'=>AdminMiddleware::class,
            'vigilante'=>VigilanteMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (Throwable $exception, $request) {
            if ($exception instanceof HttpException && $exception->getStatusCode() === 500) {
                return response()->view('page.500', [], 500);
            }
            if ($exception instanceof QueryException) {
                return response()->view('page.500', [], 500);
            }
        });
    })->create();
