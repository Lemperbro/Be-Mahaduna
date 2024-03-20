<?php
namespace App\Repositories;

use Exception;
use Carbon\Carbon;
use App\Models\Santri;
use App\Models\Tagihan;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use App\Repositories\ResponseErrorRepository;
use App\Http\Resources\Tagihan\TagihanResource;
use App\Http\Resources\Transaksi\TransaksiResource;
use App\Repositories\Interfaces\TagihanInterface;
use App\Repositories\Interfaces\TransaksiInterface;

class TagihanRepository implements TagihanInterface
{
    private $tagihanModel, $transaksiModel, $santriModel;
    private $handleResponseError;
    private $TransaksiInterface;

    public function __construct(TransaksiInterface $TransaksiInterface)
    {
        $this->tagihanModel = new Tagihan;
        $this->transaksiModel = new Transaksi;
        $this->santriModel = new Santri;
        $this->handleResponseError = new ResponseErrorRepository;
        $this->TransaksiInterface = $TransaksiInterface;
    }

    /**
     * untuk mendapatkan satu data tagihan
     * @param mixed $tagihan_id id tagihan
     * 
     * @return [type]
     */
    public function getOneTagihan($tagihan_id)
    {
        try {
            $data = $this->tagihanModel->where('tagihan_id', $tagihan_id)->first();
            if ($data == null) {
                $message = 'Data tagihan tidak ditemukan';
                if (request()->wantsJson()) {
                    return $this->handleResponseError->ResponseException($message, 404);
                } else {
                    return [
                        'error' => true,
                        'message' => $message
                    ];
                }
            }

            if (request()->wantsJson()) {
                return(TagihanResource::make($data))->response()->setStatusCode(200);
            } else {
                return $data;
            }
        } catch (Exception $e) {
            if (request()->wantsJson()) {
                return $this->handleResponseError->responseError($e);
            } else {
                return false;
            }
        }
    }

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
    public function getAllTagihan(int $paginate = null, $keyword = null, int $bulan = null, int $tahun = null, string $status = null)
    {
        $data = $this->tagihanModel->with([
            'transaksi' => function ($transaksi) {
                $transaksi->where('payment_status', 'PAID');
            },
            'santri' => function ($santri) {
                $santri->with('jenjang');
            }
        ])->latest();

        if ($bulan !== null) {
            $data->whereMonth('date', $bulan);
        }
        if ($tahun !== null) {
            $data->whereYear('date', $tahun);
        }
        if ($status !== null && $status == 'sudah') {
            $data->where('status', 'sudah dibayar');
        } else if ($status !== null && $status == 'belum') {
            $data->where('status', 'belum dibayar');
        } else if ($status !== null && $status == 'menunggu') {
            $data->where('status', 'menunggu dibayar');
        }
        if ($keyword !== null) {
            $data->whereHas('santri', function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            });
        }
        if ($paginate !== null) {
            $datas = $data->paginate($paginate);
        } else {
            $datas = $data->get();
        }

        if (request()->wantsJson()) {
            return(TagihanResource::collection($datas))->response()->setStatusCode(200);
        } else {
            return $datas;
        }
    }
    /**
     * untuk menghitung semua data tagihan
     * @return [type]
     */
    public function countAll()
    {
        $count = $this->tagihanModel->count();
        return $this->formatAngka($count);
    }
    /**
     * untuk menghitung semua data tagihan yang belum di bayar
     * @return [type]
     */
    public function countTagihanBelumBayar()
    {
        $count = $this->tagihanModel->whereIn('status', ['belum dibayar', 'menunggu dibayar'])->count();
        return $this->formatAngka($count);
    }
    /**
     * untuk menghitung semua data tagihan yang sudah dibayar
     * @return [type]
     */
    public function countTagihanSudahDibayar()
    {
        $count = $this->tagihanModel->where('status', 'sudah dibayar')->count();
        return $this->formatAngka($count);
    }

    /**
     * untuk membuat tagihan
     * @param mixed $data data yang akan di simpan ke db tagihan
     * 
     * @return [type]
     */
    public function createTagihan($data)
    {
        try {
            $cekSantriId = $this->santriModel->whereIn('santri_id', $data->santri)->count();
            if ($cekSantriId <= 0) {
                $message = 'Santri yang dipilih tidak tersimpan di dalam database';
                if (request()->wantsJson()) {
                    return $this->handleResponseError->ResponseException($message, 400);
                } else {
                    return [
                        'error' => true,
                        'message' => $message
                    ];
                }
            }
            $date = Carbon::parse($data->date)->format('Y-m-d');
            $cekSudahBayar = $this->tagihanModel->whereIn('santri_id', $data->santri)->where('date', $date)->count();
            if ($cekSudahBayar > 0) {
                $message = 'Tagihan untuk bulan ' . Carbon::parse($date)->locale('id')->isoFormat(' MMMM YYYY') . ' sudah terdaftar untuk satu atau beberapa santri yang dipilih';
                if (request()->wantsJson()) {
                    return $this->handleResponseError->ResponseException($message, 400);
                } else {
                    return [
                        'error' => true,
                        'message' => $message
                    ];
                }
            }
            foreach ($data->santri as $item) {
                $create = $this->tagihanModel->create([
                    'label' => $data->label,
                    'santri_id' => $item,
                    'price' => $data->price,
                    'date' => $date,
                    'status' => 'belum dibayar',
                    'user_created' => auth()->user()->user_id,
                    'updated_at' => null
                ]);
            }
            if ($create) {
                if (request()->wantsJson()) {
                    $response = $create->fresh()->load('santri');
                    return(TagihanResource::make($response))->response()->setStatusCode(201);
                } else {
                    return true;
                }
            } else {
                $message = 'Santri yang dipilih tidak tersimpan di dalam database';
                if (request()->wantsJson()) {
                    return $this->handleResponseError->ResponseException($message, 400);
                } else {
                    return [
                        'error' => true,
                        'message' => $message
                    ];
                }
            }

        } catch (Exception $e) {

            if (request()->wantsJson()) {
                return $this->handleResponseError->responseError($e);
            } else {
                return false;
            }
        }
    }
    /**
     * untuk update Tagihan
     * @param mixed $data data terbaru 
     * @param mixed $oldData data yang akan di update
     * 
     * @return [type]
     */
    public function updateTagihan($data, $oldData)
    {
        try {

            $checkTransaksi = $this->transaksiModel->where('tagihan_id', $oldData->tagihan_id)->whereIn('payment_status', ['PENDING', 'PAID'])->count();
            if ($checkTransaksi > 0) {
                $message = 'Tidak dapat merubah tagihan, Transaksi Sedang Berjalan';
                if (request()->wantsJson()) {
                    return $this->handleResponseError->ResponseException($message, 400);
                } else {
                    return [
                        'error' => true,
                        'message' => $message
                    ];
                }
            }
            $date = Carbon::parse($data->date)->format('Y-m-d');
            $oldData->update([
                'label' => $data->label,
                'santri_id' => $oldData->santri_id,
                'price' => $data->price,
                'date' => $date,
                'user_updated' => auth()->user()->user_id
            ]);

            if (request()->wantsJson()) {
                return(TagihanResource::make($oldData->fresh()))->response()->setStatusCode(200);
            } else {
                return true;
            }
        } catch (Exception $e) {

            if (request()->wantsJson()) {
                return $this->handleResponseError->responseError($e);
            } else {
                return false;
            }
        }
    }
    /**
     * untuk konfirmasi tagihan kalau sudah bayar tanpa lewat payment gateway
     * @param string $payment_type tipe pembayaran yang di lakukan untuk bayar (cash,transfer)
     * @param mixed $data data tagihan 
     * 
     * @return [type]
     */
    public function konfirmasiTagihan(string $payment_type, $data)
    {
        try {
            DB::beginTransaction();
            $cekPaymentType = !in_array($payment_type, ['cash', 'transfer']);
            if ($cekPaymentType) {
                if (request()->wantsJson()) {
                    return $this->handleResponseError->ResponseException('payment type tidak valid', 400);
                } else {
                    return [
                        'error' => true,
                        'message' => 'payment type tidak valid'
                    ];
                }
            }

            $data->update([
                'status' => 'sudah dibayar',
                'payment_type' => $payment_type,
                'user_updated' => auth()->user()->user_id
            ]);
            $cekTransaksiPending = $this->TransaksiInterface->checkTransaksiIsPending($data->tagihan_id);
            if ($cekTransaksiPending) {
                $this->transaksiModel->where('tagihan_id', $data->tagihan_id)->where('payment_status', 'PENDING')->update([
                    'payment_status' => 'PAID',
                    'pay' => $data->price,
                    'user_updated' => auth()->user()->user_id,
                ]);
            } else {
                $transaksi = $this->transaksiModel->create([
                    'tagihan_id' => $data->tagihan_id,
                    'price' => $data->price,
                    'pay' => $data->price,
                    'payment_status' => 'PAID',
                    'payment_type' => 'manual',
                    'user_created' => auth()->user()->user_id,
                    'updated_at' => null
                ]);
            }

            DB::commit();
            if (request()->wantsJson()) {
                return(TransaksiResource::make($transaksi->fresh()))->response()->setStatusCode(201);
            } else {
                return true;
            }
        } catch (Exception $e) {
            DB::rollBack();

            if (request()->wantsJson()) {
                return $this->handleResponseError->responseError($e);
            } else {
                return false;
            }
        }
    }
    /**
     * untuk menghapus data tagihan
     * @param mixed $data data yang akan di hapus
     * 
     * @return [type]
     */
    public function deleteTagihan($data)
    {
        try {
            DB::beginTransaction();
            $cekTransaksiPending = $this->transaksiModel->where('tagihan_id', $data->tagihan_id)->where('payment_status', 'PENDING')->count();
            if ($cekTransaksiPending > 0) {
                $message = 'Tidak berhasil menghapus tagihan, Transaksi sedang berjalan';
                if (request()->wantsJson()) {
                    return $this->handleResponseError->ResponseException($message, 400);
                } else {
                    return [
                        'error' => true,
                        'message' => $message
                    ];
                }
            }
            $updateTagihan = $data->update([
                'deleted_at' => now(),
                'user_deleted' => auth()->user()->user_id,
                'deleted' => true,
                'user_updated' => null
            ]);
            $data->updated_at = null;
            $data->save();

            $transaksi = $this->transaksiModel->where('tagihan_id', $data->tagihan_id)->whereIn('payment_status', ['PAID', 'EXPIRED']);
            if ($transaksi->count() > 0) {
                $transaksi->update([
                    'deleted_at' => now(),
                    'user_deleted' => auth()->user()->user_id,
                    'deleted' => true,
                    'user_updated' => null,
                    'updated_at' => null
                ]);

            }
            DB::commit();
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'code' => 204,
                    'message' => 'Berhasil menghapus tagihan'
                ]);
            } else {
                return true;
            }
        } catch (Exception $e) {
            DB::rollBack();

            if (request()->wantsJson()) {
                return $this->handleResponseError->responseError($e);
            } else {
                return false;
            }
        }
    }
    /**
     * untuk mendownload data tagihan secara banyak sekaligus
     * @param array $tagihan_id id tagihan yang akan di hapus
     * 
     * @return [type]
     */
    public function deleteTagihanMultiple(array $tagihan_id)
    {
        try {
            DB::beginTransaction();
            $this->tagihanModel->whereIn('tagihan_id', $tagihan_id)->update([
                'deleted_at' => now(),
                'user_deleted' => auth()->user()->user_id,
                'deleted' => true,
                'user_updated' => null,
                'updated_at' => null
            ]);
            $transaksi = $this->transaksiModel->whereIn('tagihan_id', $tagihan_id)->whereIn('payment_status', ['PAID', 'EXPIRED']);
            if ($transaksi->count() > 0) {
                $transaksi->update([
                    'deleted_at' => now(),
                    'user_deleted' => auth()->user()->user_id,
                    'deleted' => true,
                    'user_updated' => null,
                    'updated_at' => null
                ]);

            }
            DB::commit();
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'code' => 204,
                    'message' => 'Berhasil menghapus tagihan'
                ]);
            } else {
                return true;
            }
        } catch (Exception $e) {
            DB::rollBack();
            if (request()->wantsJson()) {
                return $this->handleResponseError->responseError($e);
            } else {
                return false;
            }
        }
    }
    /**
     * untuk mendapatkan data, berapa pemasukan tahun ini
     * @return [type]
     */
    public function moneyInYear()
    {
        $tahun = Carbon::parse(now())->format('Y');
        $data = $this->transaksiModel->withTrashed()->where('payment_status', 'PAID')->whereYear('created_at', $tahun)->sum('pay');
        return $data;
    }
    /**
     * untuk memformat uang , misal 1000000 jadi 1.jt dll
     * @param mixed $angka
     * 
     * @return [type]
     */
    public static function formatAngka($angka)
    {
        if ($angka >= 1000000000000) {
            return number_format($angka / 1000000000000, 3, ',', '.') . " T";
        } elseif ($angka >= 1000000000) {
            return number_format($angka / 1000000000, 3, ',', '.') . " M";
        } elseif ($angka >= 1000000) {
            return number_format($angka / 1000000, 3, ',', '.') . " jt";
        } else {
            return number_format($angka);
        }
    }

}