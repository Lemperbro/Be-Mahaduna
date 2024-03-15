<?php
namespace App\Repositories\Interfaces;

interface TagihanInterface
{
    /**
     * untuk mendapatkan satu data tagihan
     * @param mixed $tagihan_id id tagihan
     * 
     * @return [type]
     */
    public function getOneTagihan($tagihan_id);
    /**
     * untuk mengambil semua data tagihan beserta relasi nya (santri dan transaksi)
     * @param int|null $paginate untuk mempaginate data
     * @param int|null $bulan untuk memfilter data perbulan
     * @param int|null $tahun untuk memfilter data pertahun
     * @param string|null $status untuk memfilter data berdasarkan status pembayaran 
     * @param  $keyword untuk mencari data
     * 
     * 
     * @return mixed
     */
    public function getAllTagihan(int $paginate = null, $keyword = null, int $bulan = null, int $tahun = null, string $status = null);
        /**
     * untuk menghitung semua data tagihan
     * @return [type]
     */
    public function countAll();
        /**
     * untuk menghitung semua data tagihan yang belum di bayar
     * @return [type]
     */
    public function countTagihanBelumBayar();
        /**
     * untuk menghitung semua data tagihan yang sudah dibayar
     * @return [type]
     */
    public function countTagihanSudahDibayar();
    /**
     * untuk membuat tagihan
     * @param mixed $data data yang akan di simpan ke db tagihan
     * 
     * @return [type]
     */
    public function createTagihan($data);
    /**
     * untuk update Tagihan
     * @param mixed $data data terbaru 
     * @param mixed $oldData data yang akan di update
     * 
     * @return [type]
     */
    public function updateTagihan($data, $oldData);
    /**
     * untuk konfirmasi tagihan kalau sudah bayar tanpa lewat payment gateway
     * @param string $payment_type tipe pembayaran yang di lakukan untuk bayar (cash,transfer)
     * @param mixed $data data tagihan 
     * 
     * @return [type]
     */
    public function konfirmasiTagihan(string $payment_type, $data);
    /**
     * untuk menghapus data tagihan
     * @param mixed $data data yang akan di hapus
     * 
     * @return [type]
     */
    public function deleteTagihan($data);
    /**
     * untuk mendownload data tagihan secara banyak sekaligus
     * @param array $tagihan_id id tagihan yang akan di hapus
     * 
     * @return [type]
     */
    public function deleteTagihanMultiple(array $tagihan_id);
    /**
     * untuk mendapatkan data, berapa pemasukan tahun ini
     * @return [type]
     */
    public function moneyInYear();
    /**
     * untuk memformat uang , misal 1000000 jadi 1.jt dll
     * @param mixed $angka
     * 
     * @return [type]
     */
    public static function formatAngka($angka);
}