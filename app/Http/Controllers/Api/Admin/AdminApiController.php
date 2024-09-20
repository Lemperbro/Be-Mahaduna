<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminApiController extends Controller
{

    public function findNumber()
    {
        $data = User::where('role', 'super admin')->first();
        return response()->json([
            'number' => $data->telp
        ], 200);
    }
}
