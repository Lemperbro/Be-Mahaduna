<?php
namespace App\Repositories\Interfaces;

interface AuthInterface{
    /**
     * Handle Login proses
     * @param mixed $data data yang berisi username dan password untuk login
     * 
     * @return mixed
     */
    public function login($data);
}