<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'error' => [
                        'code' => 404,
                        'message' => 'Maaf, data yang Anda cari tidak ditemukan.'
                    ],
                ], 404);
            }
        });
    }

    // /**
    //  * Render the exception into an HTTP response.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function render($request, Throwable $exception)
    // {

    //     if ($exception instanceof PostTooLargeException) {
    //         return response()->view('exception.sizeFileVeryBig', [], 413);
    //     } else if ($this->isHttpException($exception)) {

    //         return response('ya');
    //     } else {
    //         return response('tidak');
    //     }
    // }
}
