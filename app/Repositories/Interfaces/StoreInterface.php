<?php
namespace App\Repositories\Interfaces;

interface StoreInterface
{
    /**
     * untuk mendapatkan semua data produk
     * @param int $paginate untuk mempaginate data , default 20
     * @param  $keyword untuk mencari data
     * @param string|null $stock untuk memfilter data, menampilkan stock terbanyak atau sedikit, nilai terbanyak atau sedikit
     * 
     * @return [type]
     */
    public function getAllProduk(int $paginate = 20, $keyword = null, string $stock = null);
    /**
     * untuk menambah produk atau data ke db store
     * @param mixed $data data yang akan disimpan
     * 
     * @return [type]
     */
    public function create($data);
    /**
     * untuk memperbarui data store
     * @param mixed $data data dari form yang akan disimpan ke db
     * @param mixed $oldData data dari db yang akan di perbarui
     * 
     * @return [type]
     */
    public function update($data, $oldData);
        /**
     * untuk menghapus produk
     * @param mixed $data data yang akan di hapus
     * 
     * @return [type]
     */
    public function delete($data);
}