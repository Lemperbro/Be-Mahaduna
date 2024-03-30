<?php
namespace App\Repositories\Hafalan;

use Exception;
use Carbon\Carbon;
use App\Models\MonitorBulanan;
use App\Repositories\Hafalan\HafalanInterface;
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
            $data = $this->monitorBulanan->with('santri')->latest();
            if ($keyword !== null) {
                $data->whereHas('santri', function ($item) use ($keyword) {
                    $item->where('nama', 'like', '%' . $keyword . '%');
                });
            }

            if ($tahun !== null) {
                $data->whereHas('santri', function ($item) use ($tahun) {
                    $item->whereYear('tgl_masuk', $tahun);
                });
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
    public function update($data, $oldData){
        try{
            $update = $oldData->update([
                'progres' => $data->progres,
                'bulan' => Carbon::parse($data->bulan)->format('Y-m-d'),
                'user_updated' => auth()->user()->user_id,
            ]);
            return $update;
        }catch(Exception $e){
            return $this->handleResponseError->responseError($e);
        }
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