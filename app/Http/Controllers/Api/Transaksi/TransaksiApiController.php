<?php

namespace App\Http\Controllers\Api\Transaksi;

use App\Models\Tagihan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Transaksi\TransaksiInterface;

class TransaksiApiController extends Controller
{
    private $TransaksiInterface;

    public function __construct(TransaksiInterface $TransaksiInterface)
    {
        $this->TransaksiInterface = $TransaksiInterface;
    }

    public function createTransaksiByXendit(Tagihan $id)
    {
        return $this->TransaksiInterface->createTransaksiByXendit($id);
    }
    public function webhooksXendit(Request $request){
        // return $this->TransaksiInterface->webhooksXendit($request);
        return true;
    }
}
