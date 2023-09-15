<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Client\ConnectionException;
use Symfony\Component\ErrorHandler\Error\FatalError;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
    if ($exception instanceof ModelNotFoundException) {
        // Check if the user is authenticated
        if (!$request->user()) {
            return redirect('/login'); // Redirect unauthenticated users to the login page
        } else {
            return response()->view('errors.custom_error', [], 404); // Display a custom error view for authenticated users
        }
    }

    return parent::render($request, $exception);
    }
    
}
