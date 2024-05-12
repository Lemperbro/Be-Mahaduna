<?php
namespace App\Repositories\Jenjang;


interface JenjangInterface{
     /**
     * untuk mengambil semua data jenjang
     * @return [type]
     */
    public function getAll();   
     /**
     * untuk menambah data kelas 
     * @param mixed $data
     * 
     * @return [type]
     */
    public function tambahKelas($data);
    /**
     * untuk mengubah data kelas
     * @param mixed $data
     * @param mixed $oldData
     * 
     * @return [type]
     */
    public function updateDataKelas($data, $oldData);
}