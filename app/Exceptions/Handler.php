<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
        $this->renderable(function (NotFoundHttpException $e, Request $request) {
                return response()->json([
                    "code" => 404,
                    'message' => 'Url Path Not Found.'
                ], 404);
        });

        $this->renderable(function (\ErrorException $e, Request $request) {
                return response()->json([
                    "code" => 403,
                    'message' => 'Forbidden'
                ], 403);
        });

        $this->renderable(function (AuthorizationException $e, Request $request) {
                return response()->json([
                    "code" => 403,
                    'message' => 'Unauthorised to do this action'
                ], 403);
        });
        $this->renderable(function (MethodNotAllowedHttpException $e, Request $request) {
                return response()->json([
                    "code" => 405,
                    'message' => 'HTTP method not allowed'
                ], 405);
        });

    }
}
