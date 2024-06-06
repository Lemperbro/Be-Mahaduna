<?php

namespace App\Http\Controllers\Api\Fcm;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Fcm\FcmRequest;
use App\Models\FcmToken;
use Exception;
use Illuminate\Http\Request;

class FcmApiController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new FcmToken;
    }

    public function saveToken(FcmRequest $request)
    {
        try {
            $tokenIsReady = $this->model->where('token', $request->token)->count();
            if ($tokenIsReady > 0) {
                $save = $this->model->create([
                    'token' => $request->token
                ]);
                if ($save) {
                    return response()->json(['message' => 'token berhasil disimpan'], 200);
                } else {
                    return response()->json(['message' => 'token tidak berhasil disimpan'], 500);
                }
            } else {
                return response()->json(['message' => 'token sudah ada'], 500);
            }
        } catch (Exception $e) {
            return response()->json(['message' => 'token tidak berhasil disimpan'], 500);

        }
    }
}
