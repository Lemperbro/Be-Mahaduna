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
}