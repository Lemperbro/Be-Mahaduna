<?php
namespace App\Repositories\Interfaces;

interface MonitoringMingguanInterface
{
    /**
     * untuk mendapatkan semua data monitoring mingguan
     * @param int $paginate
     * @param mixed $kategori
     * @param $keyword
     * @param int|null $tahun
     * @param int|null $jenjang_id
     * 
     * @return [type]
     */
    public function getAll($kategori, $paginate = null, $keyword = null, int $tahun = null, int $jenjang_id = null);
        /**
     * untuk menambah data monitoring
     * @param mixed $data
     * @param mixed $type
     * 
     * @return [type]
     */
    public function store($data, $type);
        /**
     * untuk mendapatkan data monitoring berdasarkan santri
     * @param mixed $kategori
     * @param mixed $santriId
     * @param int $paginate
     * 
     * @return [type]
     */
    public function getAllwhereSantri($kategori, $santriId, $paginate = 10);
        /**
     * untuk menghapus data monitoring secara banyaj
     * @param array $monitoring_id
     * 
     * @return [type]
     */
    public function deleteDataMultiple(array $monitoring_id);
}