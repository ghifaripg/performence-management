<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     */
    protected $dontReport = [];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     */
    protected $dontFlash = ['password', 'password_confirmation'];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register()
    {
        $this->renderable(function (Throwable $e, $request) {
            if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
                return response()->view('errors.404', [], 404);
            }
        });
    }
}
