<?php
namespace App\Repositories\HandleError;

use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;


class ResponseErrorRepository
{
    public function responseError($e = null)
    {
        $statusCode = 500;
        $errorMessage = 'Internal Server Error';
        if ($e !== null) {
            if ($e instanceof HttpResponseException) {
                $response = $e->getResponse();
                $statusCode = $response->getStatusCode();
                $errorMessage = json_decode($response->getContent(), true)['error']['message'] ?? $errorMessage;
            } elseif ($e instanceof Exception) {
                $errorMessage = $e->getMessage();
            }
        }

        return response()->json([
            'error' => [
                'code' => $statusCode,
                'message' => $errorMessage,
            ],
        ], $statusCode);
    }



    public function ResponseException($message = 'gagal mengolah data', $statusCode = 500)
    {
        throw new HttpResponseException(response([
            'error' => [
                'code' => $statusCode,
                'message' => $message
            ],
        ], $statusCode));
    }
}