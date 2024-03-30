<?php
namespace App\Repositories\Auth;

use Exception;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Auth\AuthInterface;

class AuthRepository implements AuthInterface
{


    public function login($data)
    {
            if (Auth::attempt($data->validated())) {
                $data->session()->regenerate();
                return redirect()->intended('dashboard')->with('toast_success', 'login berhasil');
            }
            return redirect()->back()->with('toast_error', 'Login Gagal! Email atau password tidak valid.');
    }
}