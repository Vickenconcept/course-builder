<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Client\ConnectionException;
use Symfony\Component\ErrorHandler\Error\FatalError;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        // if (
        //     $exception instanceof \Illuminate\Database\QueryException ||
        //     $exception instanceof \GuzzleHttp\Exception\ConnectException ||
        //     $exception instanceof \Illuminate\Http\Exceptions\ThrottleRequestsException ||
        //     $exception instanceof ConnectionException||
        //     $exception instanceof FatalError && strpos($exception->getMessage(), 'Maximum execution time') !== false
        // ) {
        //     // Customize the error message
        //     return response()->view('errors.custom_error', [], 500);
        // }

        // return parent::render($request, $exception);
    }
    
}
