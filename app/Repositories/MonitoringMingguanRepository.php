<?php
namespace App\Repositories;

use Exception;
use Carbon\Carbon;
use App\Models\MonitorMingguan;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\ResponseErrorRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Interfaces\MonitoringMingguanInterface;
use App\Http\Resources\MonitorMingguan\MonitorMingguanResource;

class MonitoringMingguanRepository implements MonitoringMingguanInterface
{
    private $monitoringMingguanModel;
    private $handleResponseError;
    public function __construct()
    {
        $this->monitoringMingguanModel = new MonitorMingguan;
        $this->handleResponseError = new ResponseErrorRepository;
    }
    /**
     * untuk mendapatkan semua data monitoring mingguan
     * @param int $paginate
     * @param mixed $kategori
     * @param $keyword
     * @param int|null $tahun
     * @param int|null $jenjang_id
     * 
     * @return [type]
     */
    public function getAll($kategori, $paginate = null, $keyword = null, int $tahun = null, int $jenjang_id = null)
    {
        try {
            if (!in_array($kategori, ['ngaji', 'sholat jamaah'])) {
                $message = 'Mohon maaf, kategori tidak tersedia';
                return $this->handleResponseError->ResponseException($message, 404);
            }
            $data = $this->monitoringMingguanModel->with([
                'santri'
            ])->where('kategori', $kategori)->latest();

            if ($keyword !== null) {
                $data->whereHas('santri', function ($query) use ($keyword) {
                    $query->where('nama', 'like', '%' . $keyword . '%');
                });
            }
            if ($tahun !== null) {
                $data->whereHas('santri', function ($item) use ($tahun) {
                    $item->whereYear('tgl_masuk', $tahun);
                });
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
     * untuk menambah data monitoring
     * @param mixed $data
     * @param mixed $type
     * 
     * @return [type]
     */
    public function store($data, $type){
        try{
            if(!in_array($type, ['sholat', 'ngaji'])){
                return [
                    'error' => true,
                    'message' => 'Tidak berhasil menambah data monitoring'
                ];
            }
            $type = $type === 'sholat' ? 'sholat jamaah' : 'ngaji';
            $create = $this->monitoringMingguanModel->create([
                'santri_id' => $data->santri,
                'hadir' => $data->hadir,
                'tidak_hadir' => $data->tidak_hadir,
                'terlambat' => $data->terlambat,
                'kategori' => $type
            ]);

            if($create){
                return true;
            }
        }catch(Exception $e){
            return $this->handleResponseError->responseError($e);
        }
    }
    /**
     * untuk mendapatkan data monitoring berdasarkan santri
     * @param mixed $kategori
     * @param mixed $santriId
     * @param int $paginate
     * 
     * @return [type]
     */
    public function getAllwhereSantri($kategori, $santriId, $paginate = 10)
    {
        if (!in_array($kategori, ['ngaji', 'sholat jamaah'])) {
            $message = 'Mohon maaf, kategori tidak tersedia';
            return $this->handleResponseError->ResponseException($message, 404);
        }
        $data = $this->monitoringMingguanModel->with(['santri'])->where('kategori', $kategori)->where('santri_id', $santriId)->latest();

        $result = $data->get()->groupBy(function ($item) {
            return $item->created_at;
        });
        $result = $this->getManualPagination($paginate, $result);

        return(MonitorMingguanResource::collection($result))->response()->setStatusCode(200);
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
     * untuk menghapus data monitoring secara banyaj
     * @param array $monitoring_id
     * 
     * @return [type]
     */
    public function deleteDataMultiple(array $monitoring_id)
    {
        try {
            $delete = $this->monitoringMingguanModel->whereIn('monitor_mingguan_id', $monitoring_id)->update([
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