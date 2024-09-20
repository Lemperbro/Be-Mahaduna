<?php

namespace App\Http\Controllers\Api\Wali;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Wali\WaliLoginRequest;
use App\Http\Requests\Api\Wali\WaliUpdateProfileRequest;
use App\Repositories\Wali\WaliInterface;
use Illuminate\Http\Request;

class WaliApiController extends Controller
{
    private $WaliInterface;
    public function __construct(WaliInterface $WaliInterface)
    {
        $this->WaliInterface = $WaliInterface;
    }
    public function login(WaliLoginRequest $request)
    {
        $login = $this->WaliInterface->login($request);
        return $login;
    }
    public function logout(Request $request)
    {
        $logout = $this->WaliInterface->logout($request);
        return $logout;
    }
    public function findWali(Request $request)
    {
        $withSantri = $request->withSantri ?? false;
        $data = $this->WaliInterface->findWali(withSantri: $withSantri);
        return $data;
    }
    public function updateProfile(WaliUpdateProfileRequest $request)
    {
        $oldData = auth()->user();
        $data = $request;
        $update = $this->WaliInterface->updateProfileViaMobile($data, $oldData);
        return $update;
    }
}
