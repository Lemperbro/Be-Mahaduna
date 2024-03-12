<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
        $this->reportable(function (NotFoundHttpException $e, $request) {
            if ($request->is(route('/tagihan/create-billing/*'))) {
                return response()->json([
                    'error' => true,
                    'message' => 'Data tidak ditemukan',
                    'code' => 404
                ],404);
            }
        });
    }
}
