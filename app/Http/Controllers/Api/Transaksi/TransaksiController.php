<?php

namespace App\Http\Controllers\Api\Transaksi;

use App\Models\Tagihan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\TransaksiInterface;

class TransaksiController extends Controller
{
    private $TransaksiInterface;

    public function __construct(TransaksiInterface $TransaksiInterface)
    {
        $this->TransaksiInterface = $TransaksiInterface;
    }

    public function createTransaksiByXendit(Tagihan $id)
    {
        return $id;
        $transaksi = $this->TransaksiInterface->createTransaksiByXendit($id);
        return $transaksi;
    }
    public function webhooksXendit(Request $request){
        return $this->TransaksiInterface->webhooksXendit($request);
    }
}
