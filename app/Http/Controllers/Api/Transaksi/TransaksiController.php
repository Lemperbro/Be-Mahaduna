<?php

namespace App\Http\Controllers\Api\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Tagihan;
use App\Repositories\Interfaces\TransaksiInterface;
use GuzzleHttp\Psr7\Request;

class TransaksiController extends Controller
{
    private $TransaksiInterface;

    public function __construct(TransaksiInterface $TransaksiInterface)
    {
        $this->TransaksiInterface = $TransaksiInterface;
    }

    public function createTransaksiByXendit(Tagihan $id)
    {
        $transaksi = $this->TransaksiInterface->createTransaksiByXendit($id);
        return $transaksi;
    }
    public function webhooksXendit(Request $request){
        return $this->TransaksiInterface->webhooksXendit($request);
    }
}
