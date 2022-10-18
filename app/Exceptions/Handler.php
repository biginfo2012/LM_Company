<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
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

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson()
            ? response()->json(['message' => $exception->getMessage()], 401)
            : redirect()->guest(route('login'));
    }

    public function report(Throwable $e)
    {
//        if ($e instanceof \Illuminate\Session\TokenMismatchException) {
//            return redirect()->route('login');
//        }
        if ($e->getPrevious() instanceof \Illuminate\Session\TokenMismatchException) {
            return redirect()->route('login');
        };
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
//    public function render($request, Exception $exception)
//    {
//        // 「the page has expired due to inactivity. please refresh and try again」を表示させない
//        if ($exception instanceof TokenMismatchException) {
//            return redirect('/login')->with('message', 'セッションの有効期限が切れました。再度ログインしてください。');
//        }
//
//        return parent::render($request, $exception);
//    }

    /**
     * Render the given HttpException.
     *
     * @param  \Symfony\Component\HttpKernel\Exception\HttpExceptionInterface  $e
     * @return \Symfony\Component\HttpFoundation\Response
     */
//    protected function renderHttpException(HttpExceptionInterface $e)
//    {
//        $this->registerErrorViewPaths();
//
//        // 「the page has expired due to inactivity. please refresh and try again」を表示させない
//        if ($e->getStatusCode() === 419) {
//            return redirect('/login');
//        }
//
//        if (view()->exists($view = "errors::{$e->getStatusCode()}")) {
//            return response()->view($view, [
//                'errors' => new ViewErrorBag,
//                'exception' => $e,
//            ], $e->getStatusCode(), $e->getHeaders());
//        }
//
//        return $this->convertExceptionToResponse($e);
//    }
}
