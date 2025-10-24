<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    // Exceptions not reported
    protected $dontReport = [
        //
    ];

    // Inputs not flashed on validation errors
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception)
    {
        // 1️⃣ Handle Spatie UnauthorizedException
        if ($exception instanceof UnauthorizedException
            || ($exception instanceof HttpException && $exception->getStatusCode() === 403)) {
  
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You do not have permission to access this resource.',
                ], 403);
            }

            return response()->view('errors.permission', [
                'message' => 'You do not have permission to view this page.'
            ], 403);
        }

        // 2️⃣ Handle authentication errors
        if ($exception instanceof AuthenticationException) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not authenticated.'
                ], 401);
            }

            return redirect()->guest(route('login'));
        }

        // 3️⃣ Handle validation errors
        if ($exception instanceof ValidationException) {
            return response()->json([
                'success' => false,
                'errors' => $exception->errors(),
                'message' => 'Validation failed.'
            ], 422);
        }

        // 4️⃣ Handle 404 Not Found
        if ($exception instanceof NotFoundHttpException) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Resource not found.'
                ], 404);
            }

            return response()->view('errors.404', [], 404);
        }

        // 5️⃣ Default handler for all other exceptions
        return parent::render($request, $exception);
    }
}
