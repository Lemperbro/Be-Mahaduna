<?php
namespace App\Repositories\Hafalan;

interface HafalanInterface
{
    /**
     * untuk mendapatkan semua data monitoring hafalan
     * @param int $paginate
     * @param int|null $bulan
     * @param int|null $tahun
     * @param int|null $jenjang_id
     * @param string|null $keyword
     * 
     * @return [type]
     */
    public function getAll($paginate = null, int $bulan = null, int $tahun = null, int $jenjang_id = null, string $keyword = null);
    /**
     * untuk menambah data monitoring hafalan
     * @param mixed $data
     * 
     * @return [type]
     */
    public function create($data);
        /**
     * untuk update data hafalan
     * @param mixed $data
     * @param mixed $oldData
     * 
     * @return [type]
     */
    public function update($data, $oldData);
    /**
     * untuk menghapus data hafalan , bisa multiple
     * @param array $hafalan_id
     * 
     * @return [type]
     */
    public function delete(array $hafalan_id);
}