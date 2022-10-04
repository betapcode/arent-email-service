<?php

namespace App\Exceptions;

use Arent\SendMail\Traits\ApiResponseTrait;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponseTrait;
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

        $this->renderable(function (ValidationException $e, $request) {
            if ($request->is('api/*')) {
                return $this->apiResponse(
                    [
                        'success' => false,
                        'message' => $e->getMessage(),
                        'errors' => $e->errors()
                    ],
                    422
                );
            }
        });

        $this->renderable(function (PostTooLargeException $e, $request) {
            if ($request->is('api/*')) {
                return $this->apiResponse(
                    [
                        'success' => false,
                        'message' => "Size of attached file should be less " . ini_get("upload_max_filesize") . "B"
                    ],
                    400
                );
            }
        });

        $this->renderable(function (AuthenticationException $e, $request) {
            if ($request->is('api/*')) {
                return $this->apiResponse(
                    [
                        'success' => false,
                        'message' => 'Unauthenticated or Token Expired, Please Login'
                    ],
                    401
                );
            }
        });

        $this->renderable(function (ThrottleRequestsException $e, $request) {
            if ($request->is('api/*')) {
                return $this->apiResponse(
                    [
                        'success' => false,
                        'message' => 'Too Many Requests,Please Slow Down'
                    ],
                    429
                );
            }
        });

        $this->renderable(function (ModelNotFoundException $e, $request) {
            if ($request->is('api/*')) {
                return $this->apiResponse(
                    [
                        'success' => false,
                        'message' => 'Entry for ' . str_replace('App\\', '', $e->getModel()) . ' not found'
                    ],
                    404
                );
            }
        });

        $this->renderable(function (QueryException $e, $request) {
            if ($request->is('api/*')) {
                return $this->apiResponse(
                    [
                        'success' => false,
                        'message' => 'There was Issue with the Query',
                        'exception' => $e

                    ],
                    500
                );
            }
        });
    }
}
