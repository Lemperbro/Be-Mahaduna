<?php
namespace App\Repositories\Transaksi;

interface TransaksiInterface
{
    /**
     * untuk mengecek ke db transaksi , ada ngak transaksi yang status nya pending
     * @param int $tagihan_id id tagihan yang akan di cek transaksi nya
     * 
     * @return [type]
     */
    public function checkTransaksiIsPending(int $tagihan_id);
        /**
     * create Transaksi dan bikin invoice xendit
     * @param mixed $tagihan data tagihan yang akan di up ke xendit dan tabel transaksi
     * 
     * @return [type]
     */
    public function createTransaksiByXendit($tagihan);
        /**
     * untuk callback dari xendit ketika pembayaran berhasil dan transaksi expired
     * @param $request $request data dari xendit
     * 
     * @return [type]
     */
    public function webhooksXendit($request);
}