<?php
namespace App\Repositories\Interfaces;

interface JadwalInterface
{
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
    /**
     * untuk update data jadwal
     * @param mixed $data data baru untuk update
     * @param mixed $oldData data yang akan di update
     * 
     * @return [type]
     */
    public function update($data, $oldData);
    /**
     * untuk menhapus data jadwal
     * @param mixed $data data yang akan di hapus
     * 
     * @return [type]
     */
    public function delete($data);

}