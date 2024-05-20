<?php
namespace App\Repositories\ManageAdmin;

use App\Models\User;
use App\Repositories\ManageAdmin\ManageAdminInterface;
use App\Repositories\SaveFile\SaveFileRepository;
use Exception;

class ManageAdminRepository implements ManageAdminInterface
{
    private $userModel, $saveFile, $folderFileLocation;

    public function __construct()
    {
        $this->userModel = new User;
        $this->saveFile = new SaveFileRepository;
        $this->folderFileLocation = 'uploads/users';
    }


    /**
     * untuk update profile admin
     * @param mixed $data
     * 
     * @return [type]
     */
    public function updateProfile($data)
    {

        if ($data->has('image')) {
            $image = $this->saveFile->saveFileSingle($data->image, $this->folderFileLocation);
        } else {
            $image = auth()->user()->image;
        }
        $update = $this->userModel->where('user_id', auth()->user()->user_id)->update([
            'image' => $image,
            'username' => $data->username,
            'email' => $data->email,
            'telp' => $data->telp
        ]);
        if (!$update) {
            return false;
        }
        return true;

    }
}