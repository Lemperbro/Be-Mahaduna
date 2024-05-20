<?php

namespace App\Http\Controllers\Admin\ManageAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManageAdmin\ChangePasswordRequest;
use App\Http\Requests\ManageAdmin\UpdateProfileRequest;
use App\Repositories\ManageAdmin\ManageAdminInterface;
use Illuminate\Http\Request;

class ManageAdminController extends Controller
{
    private $manageAdminInterface;
    public function __construct(ManageAdminInterface $manageAdminInterface)
    {
        $this->manageAdminInterface = $manageAdminInterface;
    }

    public function profile()
    {
        $headerTitle = 'Profile Admin';
        return view('admin.manage-admin.profile', compact('headerTitle'));
    }
    public function updateProfile(UpdateProfileRequest $request)
    {
        $update = $this->manageAdminInterface->updateProfile($request);
        if (isset($update['error']) && $update['error'] == true) {
            return redirect()->back()->with('toast_error', $update['message']);
        } else if ($update) {
            return redirect()->back()->with('toast_success', 'Berhasil memperbarui data');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil memperbarui data');
        }

    }
    public function changePassword()
    {
        $headerTitle = 'Ubah Password';
        return view('admin.manage-admin.ubah-password', compact('headerTitle'));
    }

    public function changePasswordSave(ChangePasswordRequest $request)
    {
        $change = $this->manageAdminInterface->changePassword($request);
        if (isset($change['error']) && $change['error'] == true) {
            return redirect()->back()->with('toast_error', $change['message']);
        } else if ($change) {
            return redirect()->back()->with('toast_success', 'Berhasil memperbarui password');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil memperbarui password');
        }
    }
}
