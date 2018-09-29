<?php

namespace App\Exceptions;

use Exception;
use Request;
use Illuminate\Auth\AuthenticationException;
use Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException; 
use Illuminate\Validation\ValidationException;
use GuzzleHttp\Exception\ClientException;

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

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // if($request->exceptsJson()) {
            // die("HELO");
            if($exception instanceof ClientException) {
                $message = json_decode((string) $exception->getResponse()->getBody());
                return response()->json([
                    'status' => -1,
                    'data' => null,
                    'message' => $message,
                    // 'errors' => $exception->errors(),
                ], 422);
            }
        
        // }
            if($exception instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException){
                $response = [
                    'status' => 0,
                    'data' => null,
                    'message' => 'Bad request',
                ];

                return response()->json($response, 503);
            }

        // }

        return parent::render($request, $exception);
    }

    
    /**
     * Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {

        if($request->expectsJson()) {
            $response = [
                'status' => 0,
                'data' => null,
                'message' => 'Unauthenticated, token not present',
            ];

            return response()->json($response, 401);
        }

        $guard = array_get($exception->guards(), 0);

        switch($guard) {
            case 'admin': $login = 'admin.login';
            break;

            default:
            $login = 'login';
        }

        if($login === 'admin.login') {
            return redirect()->guest(route($login, ['admin' => 'admin']));
        } else if($login === 'login') {
            return redirect()->guest(route($login));
        }
        // return $request->expectsJson()
        //             ? response()->json([ 'status' => 0, 'message' => $exception->getMessage()], 401)
        //             : redirect()->guest(route('login'));
    }

}
