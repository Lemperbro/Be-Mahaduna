<?php
namespace App\Repositories\Interfaces;

interface ArtikelInterface
{
    /**
     * Semua data artikel dan relasi kategori nya
     * @param int|null $paginate untuk mempaginate data 
     * @param $keyword untuk mencari data
     * @param bool $sortBest jika true maka akan mensortir data berdasarkan views terbanyak
     * 
     * @return [JsonResource]
     */

    public function getAllArtikel(int $paginate = null, $keyword = null, bool $sortBest = false);

    /**
     * Untuk menyimpan artikel ke dala database
     * @param mixed $data data request dari form
     * 
     * @return [type]
     */
    public function createArtikel($data);
    /**
     * untuk update artikel
     * @param mixed $data data terbaru dari form
     * @param mixed $oldData data lama yang ada di database
     * 
     * @return [type]
     */
    public function updateArtikel($data, $oldData);
    /**
     * untuk hapus artikel
     * @param mixed $data data artikel yang akan dihapus
     * 
     * @return [type]
     */
    public function deleteArtikel($data);
    /**
     * Ambil semua data kategori artikel 
     * @param int|null $paginate untuk mempaginate data 
     * 
     * @return [JsonResponse]
     */
    public function getAllKategori(int $paginate = null);
    /**
     * untuk menambah kategori
     * @param mixed $data data inputan
     * 
     * @return [type]
     */
    public function createKategori($data);
    /**
     * update kategori
     * @param mixed $data data baru 
     * @param mixed $oldData data lama
     * 
     * @return [type]
     */
    public function updateKategori($data, $oldData);
    /**
     * untuk menghapus data kategori
     * @param mixed $data data kategori yang akan di hapus
     * 
     * @return [type]
     */
    public function deleteKategori($data);
}