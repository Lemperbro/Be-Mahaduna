<?php
namespace App\Repositories\Auth;

interface AuthInterface{
    /**
     * Handle Login proses
     * @param mixed $data data yang berisi username dan password untuk login
     * 
     * @return mixed
     */
    public function login($data);
    public function registerAdmin($data);
    public function resetPassword($data);
}