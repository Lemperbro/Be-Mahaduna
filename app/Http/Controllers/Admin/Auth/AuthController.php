<?php

namespace App\Http\Controllers\Admin\Auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Auth\AuthInterface;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\Auth\LoginProsesRequest;
use App\Http\Requests\Auth\RegisterAdminRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\ReqResetPasswordRequest;

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
        $countSuperAdmin = User::where('role', 'super admin')->count();
        return view('auth.login', compact('countSuperAdmin'));
    }
    public function loginProses(LoginProsesRequest $request)
    {
        return $this->AuthInterface->login($request);
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function adminRegister()
    {
        return view('auth.registerAdmin');
    }
    public function adminRegisterSave(RegisterAdminRequest $request)
    {
        $save = $this->AuthInterface->registerAdmin($request);
        if (isset($save['error']) && $save['error'] == true) {
            return redirect()->back()->with('toast_error', $save['message']);
        } else if ($save) {
            return redirect(route('auth.login'))->with('toast_success', 'Berhasil register');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil register');
        }
    }
    public function lupaPassword()
    {
        return view('auth.lupa-password');
    }

    public function createLinkReset(ReqResetPasswordRequest $request)
    {

        $status = Password::sendResetLink(
            $request->only('email')
        );
        Log::info('email', ['error' => $status]);
        return $status === Password::RESET_LINK_SENT ? redirect(route('auth.login'))->with('success', 'Link Reset Berhasil Dikirim, Silahkan Cek Email Anda') : redirect()->back()->with('error', 'Link Reset Tidak Berhasil Dikirim');

    }

    public function resetPassword($token, $email)
    {
        $check = DB::table('password_reset_tokens')->where('email', $email)->first();
        if ($check !== null) {
            if (!Hash::check($token, $check->token)) {
                return redirect(route('auth.login'))->with('error', 'Token Reset Password Tidak Valid');
            }
        } else {
            return redirect(route('auth.login'))->with('error', 'Link Reset Password Belum Dibuat, Silahkan Klik Reset Password');
        }

        return view('auth.reset-password', compact('token', 'email'));
    }
    public function saveResetPassword(ResetPasswordRequest $request)
    {
        $reset = $this->AuthInterface->resetPassword($request);
        if ($reset) {
            return redirect(route('auth.login'))->with('success', 'Password Berhasil Di Ubah');
        } else {
            return redirect()->back()->with('toast_error', 'Password Tidak berhasil diubah');
        }
    }
}
