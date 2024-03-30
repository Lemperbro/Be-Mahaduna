<?php

namespace App\Http\Controllers\Admin\Auth;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Auth\AuthInterface;
use App\Http\Requests\Auth\LoginProsesRequest;

class AuthController extends Controller
{
    private $AuthInterface;

    public function __construct(AuthInterface $AuthInterface)
    {
        $this->AuthInterface = $AuthInterface;
    }
    //
    public function login()
    {
        return view('auth.login');
    }
    public function loginProses(LoginProsesRequest $request)
    {
        return $this->AuthInterface->login($request);
    }


    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');
    }
}
