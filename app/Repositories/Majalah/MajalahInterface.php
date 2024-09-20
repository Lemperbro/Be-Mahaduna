<?php
namespace App\Repositories\Majalah;


interface MajalahInterface
{
    /**
     * untuk mengambil semua data majalah
     * @param int $paginate untuk mempaginate data 
     * @param $keyword untuk mencari data
     * @param bool $sortBest untuk mensortir data berdasarkan yang banyak di lihat 
     * 
     * @return [mixed]
     */
    public function getAll(int $paginate = 20, $keyword = null, bool $sortBest = false);
    /**
     * untuk menapilkan detail majalah
     * @param mixed $data data majalah dari db
     * 
     * @return [type]
     */
    public function showMajalah($data);
    /**
     * untuk menambah majalah
     * @param mixed $data data majalah yang akan di simpan di dalam database
     * 
     * @return mixed
     */
    public function createMajalah($data);
    /**
     * untuk mengubah majalah 
     * @param mixed $data data terbaru dari form 
     * @param mixed $oldData data yang akan di update
     * 
     * @return [type]
     */
    public function updateMajalah($data, $oldData);
    /**
     * untuk mendelete majalah
     * @param mixed $data data yang akan di hapus
     * 
     * @return [type]
     */
    public function deleteMajalah($data);
}