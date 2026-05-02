<?php

use App\Domain\Shared\Exception\ConflictException;
use App\Domain\Shared\Exception\ExceptionItem;
use App\Domain\Shared\Exception\ValidateException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // https://laravel.com/docs/13.x/errors#rendering-exceptions
        $exceptions->render(function (ValidationException $e, Request $request) {
            if ($request->is('api/*')) {
                $errors = [];
                foreach ($e->validator->errors()->messages() as $key => $messages) {
                    foreach ($messages as $message) {
                        $pointer = '/'.str_replace('.', '/', $key);
                        $errors[] = new ExceptionItem($pointer, $message, $message);
                    }
                }

                return response()->json((new ValidateException($errors))->format(), $e->status);
            }
        });

        $exceptions->render(function (ConflictException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json($e->format(), $e->getCode());
            }
        });
    })->create();
