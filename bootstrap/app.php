<?php

use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use App\Http\Middleware\PermissionUser;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(

        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/status',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Exception $exception, Request $request) {

            if ($exception instanceof NotFoundHttpException) {
                return response()->view("errors.404", [], 404);
            }

            if ($exception instanceof HttpException && $exception->getStatusCode() == 400) {
                return response()->view("admin.errors.400", [], 400);
            }

            if ($exception instanceof HttpException && $exception->getStatusCode() == 403) {
                return response()->view("admin.errors.403", [], 403);
            }

            if ($exception instanceof QueryException) {
                return response()->view(
                    'errors.500',
                    ['message' => "Il y a un problème de connexion à la base de données."],
                    500
                );
            }

            if ($exception instanceof HttpException && $exception->getStatusCode() == 503) {
                return response()->view("errors.503", [], 503);
            }
        });
    })->create();
