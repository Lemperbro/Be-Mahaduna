<?php
namespace App\Repositories\Auth;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Auth\AuthInterface;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class AuthRepository implements AuthInterface
{

    private $userModel;
    public function __construct()
    {
        $this->userModel = new User;
    }

    public function login($data)
    {
        if (Auth::attempt($data->validated())) {
            $data->session()->regenerate();
            return redirect()->intended('dashboard')->with(['toast_success' => 'login berhasil', 'welcome' => true]);
        }
        return redirect()->back()->with('toast_error', 'Login Gagal! Email atau password tidak valid.');
    }
    public function registerAdmin($data)
    {
        $save = $this->userModel->create([
            'image' => 'uploads/users/default.png',
            'username' => $data->username,
            'email' => $data->email,
            'telp' => $data->telp,
            'password' => $data->password,
            'role' => 'super admin'
        ]);
        if (!$save) {
            return false;
        }
        return true;
    }

    public function resetPassword($data)
    {
        $status = Password::reset(
            $data->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET;
    }
}