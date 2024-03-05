<?php
namespace App\Repositories\Interfaces;

interface JadwalInterface{
    /**
     * untuk mengambil semua data jadwal
     * @return [type]
     */
    public function getAll();
        /**
     * untuk menambah data jadwal
     * @param mixed $data data yang akan disimpan ke database
     * 
     * @return [type]
     */
    public function create($data);
}