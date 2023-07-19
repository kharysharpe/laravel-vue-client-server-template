<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Get the default context variables for logging.
     *
     * @return array
     */
    protected function context()
    {
        if (app()->runningInConsole()) {
            return parent::context();
        }

        $userId = 'null';

        if (Auth::check()) {
            $userId = Auth::user()->id;
        }

        return array_merge(parent::context(), [
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_id' => $userId,
        ]);
    }

    public function render($request, Throwable $e)
    {
        Log::error($e->getMessage());
        Log::debug($e->getTraceAsString());

        if ($request->is('api/*')) {

            if ($e instanceof BaseException) {
                return response()->json([
                    'error' => $e->getMessage(),
                ], 400);
            }

            if ($e instanceof AuthenticationException) {
                return response()->json(['error' => 'Not Logged In.'], 401);
            }

            if ($e instanceof ModelNotFoundException) {
                return response()->json(['error' => 'Data Missing.'], 404);
            }

            if ($e instanceof RouteNotFoundException) {
                return response()->json(['error' => 'Route Missing.'], 404);
            }

            if ($e instanceof ValidationException) {
                return response()->json([
                    'message' => 'Validation Error.',
                    'errors' => $e->errors(),
                ], 422);
            }

            return response()->json(['error' => 'Unkown Error.'], 400);
        }

        return response()->json([
            'error' => 'Internal Error.',
        ], 500);
    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json(['error' => 'Not Logged In.'], 401);
    }
}
