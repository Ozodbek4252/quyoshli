<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Sentry\State\Scope;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'status' => false,
                'error' => 401,
                'message' => trans('app.errors.401')
            ], 401);
        }

        return redirect()->guest('login');
    }

    /**
     * @param Throwable $exception
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        //        if (app()->bound('sentry') && $this->shouldReport($exception)) {
        //            $user = request()->user();
        //
        //            if (!empty($user)) {
        //                //$token = Token::where('token', $token)->first();
        //                app('sentry')->configureScope(function (Scope $scope) use ($user): void {
        //                    $scope->setUser([
        //                        'id' => $user->id,
        //                        'phone' => $user->phone,
        //                    ]);
        //                });
        //            }
        //
        //            app('sentry')->captureException($exception);
        //        }

        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            app('sentry')->captureException($exception);
        }

        parent::report($exception);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param Throwable $exception
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return response()->view('errors.404', [], 404);
            //            return response()->json([
            //                'status' => false,
            //                'error' => 100,
            //                'message' => trans('app.errors.100')
            //            ], 403);
        }

        return parent::render($request, $exception);
    }
}
