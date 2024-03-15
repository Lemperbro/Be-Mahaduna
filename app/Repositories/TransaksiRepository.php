<?php
namespace App\Repositories;

use Exception;
use Carbon\Carbon;
use App\Models\Tagihan;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\ResponseErrorRepository;
use App\Repositories\Interfaces\XenditInterface;
use App\Http\Resources\Transaksi\TransaksiResource;
use App\Repositories\Interfaces\TransaksiInterface;
use App\Http\Resources\Transaksi\TransaksiIsPendingResource;

class TransaksiRepository implements TransaksiInterface
{
    private $transaksiModel, $tagihanModel;
    private $XenditInterface;
    private $handleResponseError;
    public function __construct(XenditInterface $XenditInterface)
    {
        $this->transaksiModel = new Transaksi;
        $this->tagihanModel = new Tagihan;
        $this->XenditInterface = $XenditInterface;
        $this->handleResponseError = new ResponseErrorRepository;
    }

    /**
     * untuk mengecek ke db transaksi , ada ngak transaksi yang status nya pending
     * @param int $tagihan_id id tagihan yang akan di cek transaksi nya
     * 
     * @return [type]
     */
    public function checkTransaksiIsPending(int $tagihan_id)
    {
        $check = $this->transaksiModel->where('tagihan_id', $tagihan_id)->where('payment_status', 'PENDING')->first();
        if ($check !== null) {
            if (request()->wantsJson()) {
                return(TransaksiIsPendingResource::make($check))->response()->setStatusCode(200);
            } else {
                return true;
            }
        } else {
            if (request()->wantsJson()) {
                return response()->json(['isPending' => false], 200);
            } else {
                return false;
            }
        }
    }

    /**
     * create Transaksi dan bikin invoice xendit
     * @param mixed $tagihan data tagihan yang akan di up ke xendit dan tabel transaksi
     * 
     * @return [type]
     */
    public function createTransaksiByXendit($tagihan)
    {
        try {
            if ($tagihan->status !== 'belum dibayar') {
                $cekDiTransaksi = $this->transaksiModel->where('tagihan_id', $tagihan->tagihan_id)->whereIn('payment_status', ['PENDING', 'PAID'])->count();
                if ($cekDiTransaksi > 0) {
                    $message = 'Tidak dapat melakukan aksi, Transaksi sedang berjalan atau tagihan sudah dibayar';
                    return $this->handleResponseError->ResponseException($message, 400);
                }
            }
            DB::beginTransaction();
            $invoiceXendit = $this->XenditInterface->createInvoice($tagihan);
            $this->tagihanModel->where('tagihan_id', $tagihan->tagihan_id)->update([
                'status' => 'menunggu dibayar'
            ]);
            $createTransaksi = $this->transaksiModel->create([
                'tagihan_id' => $tagihan->tagihan_id,
                'invoice_id' => $invoiceXendit->id,
                'external_id' => $invoiceXendit->external_id,
                'payment_link' => $invoiceXendit->invoice_url,
                'price' => $tagihan->price,
                'pay' => $invoiceXendit->amount,
                'payment_type' => 'payment_gateway',
                'payment_status' => $invoiceXendit->status,
                'expired' => Carbon::parse($invoiceXendit->expiry_date)->format('Y-m-d H:i:s')
            ]);
            DB::commit();
            return(TransaksiResource::make($createTransaksi->fresh()))->response()->setStatusCode(201);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->handleResponseError->responseError($e);
        }
    }
    // asasass
    // asasasas
    /**
     * untuk callback dari xendit ketika pembayaran berhasil dan transaksi expired
     * @param $request $request data dari xendit
     * 
     * @return [type]
     */
    public function webhooksXendit($request)
    {
        try {
            $callbackToken = $request->header('x-callback-token');
            $verifyCallbackToken = $this->XenditInterface->verifyCallbackToken($callbackToken);
            if (!$verifyCallbackToken) {
                $message = 'Token tidak valid';
                return $this->handleResponseError->ResponseException($message, 403);
            }

            if ($request->status == 'PAID') {
                $payment_status = 'PAID';
                $tagihan_status = 'sudah dibayar';
                $pay = $request->paid_amount;
            } else if ($request->status == 'EXPIRED') {
                $payment_status = 'EXPIRED';
                $tagihan_status = 'belum dibayar';
                $pay = null;
            }
            DB::beginTransaction();
            $transaksi = $this->transaksiModel->where('external_id', $request->external_id)->first();
            $transaksi->update([
                'pay' => $pay,
                'payment_status' => $payment_status
            ]);
            $this->tagihanModel->where('tagihan_id', $transaksi->tagihan_id)->update([
                'status' => $tagihan_status
            ]);
            DB::commit();

            return response()->json([
                'error' => false,
                'message' => 'callback success'
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'error' => true,
                'message' => 'callback failed'
            ], 400);
        }
    }
}