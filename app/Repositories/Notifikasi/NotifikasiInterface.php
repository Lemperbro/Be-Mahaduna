<?php
namespace App\Repositories\Notifikasi;

interface NotifikasiInterface
{
    /**
     * untuk menampilkan semua notifikasi
     * @param string $for
     * @param string $paginate
     * @param int|null $wali_id
     * 
     * @return [type]
     */
    public function allNotifikasi($for = 'all', $paginate = '15', $wali_id = null);
}