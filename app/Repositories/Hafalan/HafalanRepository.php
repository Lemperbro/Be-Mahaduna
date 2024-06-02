<?php
namespace App\Repositories\Hafalan;

use App\Http\Resources\Hafalan\HafalanResource;
use Exception;
use Carbon\Carbon;
use App\Models\MonitorBulanan;
use Illuminate\Support\Collection;
use App\Repositories\Hafalan\HafalanInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\HandleError\ResponseErrorRepository;

class HafalanRepository implements HafalanInterface
{
    private $monitorBulanan;
    private $handleResponseError;

    public function __construct()
    {
        $this->monitorBulanan = new MonitorBulanan;
        $this->handleResponseError = new ResponseErrorRepository;
    }

    /**
     * untuk mendapatkan semua data monitoring hafalan
     * @param int $paginate
     * @param int|null $bulan
     * @param int|null $tahun
     * @param int|null $jenjang_id
     * @param string|null $keyword
     * 
     * @return [type]
     */
    public function getAll($paginate = null, int $bulan = null, int $tahun = null, int $jenjang_id = null, string $keyword = null)
    {
        try {
            $data = $this->monitorBulanan->with([
                'santri' => function ($santri) {
                    $santri->with([
                        'jenjang' => function ($jenjang) {
                            $jenjang->withTrashed();
                        }
                    ]);
                }
            ])->latest();
            if ($keyword !== null) {
                $data->whereHas('santri', function ($item) use ($keyword) {
                    $item->where('nama', 'like', '%' . $keyword . '%');
                });
            }

            if ($tahun !== null) {
                $data->whereYear('created_at', $tahun);
            }

            if ($bulan !== null) {
                $data->whereMonth('bulan', $bulan);
            }
            if ($jenjang_id !== null) {
                $data->whereHas('santri', function ($item) use ($jenjang_id) {
                    $item->where('jenjang_id', $jenjang_id);
                });
            }
            if ($paginate !== null) {
                $result = $data->paginate($paginate);
            } else {
                $result = $data->get();
            }
            return $result;
        } catch (Exception $e) {
            return $this->handleResponseError->responseError($e);
        }
    }

    /**
     * untuk menambah data monitoring hafalan
     * @param mixed $data
     * 
     * @return [type]
     */
    public function create($data)
    {
        try {
            $create = $this->monitorBulanan->create([
                'santri_id' => $data->santri,
                'progres' => $data->progres,
                'bulan' => Carbon::parse($data->bulan)->format('Y-m-d'),
                'user_created' => auth()->user()->user_id,
                'updated_at' => null
            ]);
            return $create;
        } catch (Exception $e) {
            return $this->handleResponseError->responseError($e);
        }
    }
    /**
     * untuk update data hafalan
     * @param mixed $data
     * @param mixed $oldData
     * 
     * @return [type]
     */
    public function update($data, $oldData)
    {
        try {
            $update = $oldData->update([
                'progres' => $data->progres,
                'bulan' => Carbon::parse($data->bulan)->format('Y-m-d'),
                'user_updated' => auth()->user()->user_id,
            ]);
            return $update;
        } catch (Exception $e) {
            return $this->handleResponseError->responseError($e);
        }
    }
    /**
     * ambil semua data monitoring hafalan , berdasarkan santri
     * @param mixed $santriId
     * @param int $paginate
     * 
     * @return [type]
     */
    public function getAllWhereSantri($santriId, $paginate = 10)
    {
        try {
            $data = $this->monitorBulanan->where('santri_id', $santriId)->latest()->get();


            $result = $this->getManualPagination($paginate, $data);
            return (HafalanResource::collection($result))->response()->setStatusCode(200);

        } catch (Exception $e) {
            return $this->handleResponseError->responseError($e);

        }
    }
    public function getManualPagination($perPage, $data)
    {
        $currentPage = request()->get('page', 1); // Nomor halaman saat ini

        $slicedData = (new Collection($data))->forPage($currentPage, $perPage)->values();
        $total = $data->count();

        return $dataSemuafix = new LengthAwarePaginator(
            $slicedData,
            $total,
            $perPage,
            $currentPage,
            ['path' => request()->url()]
        );
    }
    /**
     * untuk menghapus data hafalan , bisa multiple
     * @param array $hafalan_id
     * 
     * @return [type]
     */
    public function delete(array $hafalan_id)
    {
        try {
            $delete = $this->monitorBulanan->whereIn('monitor_bulanan_id', $hafalan_id)->update([
                'deleted_at' => now(),
                'user_deleted' => auth()->user()->user_id,
                'deleted' => true,
                'user_updated' => null,
                'updated_at' => null
            ]);
            if (!$delete) {
                $message = 'Tidak berhasil menghapus data';
                return [
                    'error' => true,
                    'message' => $message
                ];
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}