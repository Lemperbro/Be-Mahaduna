<?php
namespace App\Repositories\ManageAdmin;


interface ManageAdminInterface
{
    /**
     * untuk update profile admin
     * @param mixed $data
     * 
     * @return [type]
     */
    public function updateProfile($data);
    /**
     * ubah password
     * @param mixed $data
     * 
     * @return [type]
     */
    public function changePassword($data);
}