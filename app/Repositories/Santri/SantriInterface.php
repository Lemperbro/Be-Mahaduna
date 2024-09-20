<?php
namespace App\Repositories\Santri;

interface SantriInterface
{
    /**
     * untuk mengambil semua data santri dan relasinya (jenjang)
     * @param $paginate untuk mempaginate data
     * @param  $tahunMasuk untuk memfilter data berdasarkan tahun masuk
     * @param int|null $jenjang untuk memfilter data berdasarkan jenjang
     * @param string|null $status untuk memfilter data berdasarkan status
     * @param string|null $jenisKelamin untuk memfilter data berdasarkan jenis kelamin
     * @param string|null $keyword
     * 
     * @return [type]
     */
    public function getAll($paginate = null, string $keyword = null, $tahunMasuk = null, int $jenjang = null, string $status = null, string $jenisKelamin = null);
    /**
     * untuk menambah santri
     * @param mixed $data
     * 
     * @return [type]
     */
    public function create($data);
    /**
     * untuk memperbarui data santri
     * @param mixed $oldData
     * @param mixed $data
     * 
     * @return [type]
     */
    public function update($oldData, $data);
    /**
     * ubah kelas
     * @param mixed $data
     * 
     * @return [type]
     */
    public function ubahKelas($data);
    /**
     * untuk merubah status santri
     * @param mixed $data
     * 
     * @return [type]
     */
    public function ubahStatus($data);
    /**
     * untuk menghapus data santri , bisa multiple
     * @param array $santri_id
     * 
     * @return [type]
     */
    public function delete(array $santri_id);

}