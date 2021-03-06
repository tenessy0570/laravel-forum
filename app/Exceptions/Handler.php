<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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

    public static function raise404()
    {
        return response()->json([
            'error' => 'Not found'
        ], 404);
    }

    public static function raise403()
    {
        return response()->json([
            'error' => 'Forbidden for you'
        ], 403);
    }

    public static function raise404_error($message)
    {
        return response()->json([
            'error' => $message
        ], 404);
    }

    public static function raise200_ok()
    {
        return response()->json([
            'success' => 'true'
        ], 200);
    }
}
