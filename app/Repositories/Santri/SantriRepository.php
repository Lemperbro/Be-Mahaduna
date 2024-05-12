<?php
namespace App\Repositories\Santri;

use App\Models\Jenjang;
use Exception;
use Carbon\Carbon;
use App\Models\Santri;
use App\Models\WaliRelasi;
use App\Models\MonitorBulanan;
use App\Models\MonitorMingguan;
use Illuminate\Support\Facades\DB;
use App\Repositories\Santri\SantriInterface;
use App\Http\Resources\Santri\SantriResource;

class SantriRepository implements SantriInterface
{
    private $santriModel, $santriRelasiModel, $monitoringBulananModel, $monitoringMingguanModel, $jenjangModel;
    public function __construct()
    {
        $this->santriModel = new Santri;
        $this->santriRelasiModel = new WaliRelasi;
        $this->monitoringBulananModel = new MonitorBulanan;
        $this->monitoringMingguanModel = new MonitorMingguan;
        $this->jenjangModel = new Jenjang;
    }

    /**
     * untuk mengambil semua data santri dan relasinya (jenjang)
     * @param $paginate untuk mempaginate data
     * @param  $tahunMasuk untuk memfilter data berdasarkan tahun masuk
     * @param int|null $jenjang untuk memfilter data berdasarkan jenjang
     * @param string|null $status untuk memfilter data berdasarkan status
     * @param string|null $jenisKelamin untuk memfilter data berdasarkan jenis kelamin
     * @param string|null $keyword
     * 
     * @return [type]
     */
    public function getAll($paginate = null, string $keyword = null, $tahunMasuk = null, int $jenjang = null, string $status = null, string $jenisKelamin = null)
    {
        $data = $this->santriModel->with('jenjang', 'waliRelasi.wali')->latest();
        if ($keyword !== null) {
            $data->where('nama', 'like', '%' . $keyword . '%');
        }
        if ($tahunMasuk !== null) {
            if (request('status') == 'lulus') {
                $data->whereYear('tgl_keluar', $tahunMasuk);
            } else {
                $data->whereYear('tgl_lahir', $tahunMasuk);
            }
        }
        if ($jenjang !== null) {
            $data->where('jenjang_id', $jenjang);
        }
        if ($status !== null) {
            $data->where('status', $status);
        } else {
            $data->where('status', 'aktif');
        }
        if ($jenisKelamin !== null) {
            $data->where('jenis_kelamin', $jenisKelamin);
        }

        if ($paginate !== null) {
            $datas = $data->paginate($paginate);
        } else {
            $datas = $data->get();
        }

        if (request()->wantsJson()) {
            return (SantriResource::collection($datas))->response()->setStatusCode(200);
        } else {
            return $datas;
        }
    }
    /**
     * untuk menambah santri
     * @param mixed $data
     * 
     * @return [type]
     */
    public function create($data)
    {
        DB::beginTransaction();
        $create = $this->santriModel->create([
            'nama' => $data->nama,
            'jenjang_id' => $data->jenjang,
            'tgl_lahir' => Carbon::parse($data->tgl_lahir)->format('Y-m-d'),
            'jenis_kelamin' => $data->jenis_kelamin,
            'status' => 'aktif',
        ]);
        $createRelasi = $this->santriRelasiModel->create([
            'wali_id' => $data->wali,
            'santri_id' => $create->santri_id
        ]);
        DB::commit();
        if (!$create || !$createRelasi) {
            DB::rollBack();
            return false;
        }
        return true;
    }
    /**
     * untuk merubah status santri ke lulus
     * @param mixed $data
     * 
     * @return [type]
     */
    public function toLulus($data)
    {
        if ($data->tgl_keluar == null) {
            return [
                'error' => true,
                'message' => 'Tanggal Kelulusan Harus Di isi'
            ];
        }
        $santri_id = explode('|', $data->santri_id);
        $update = $this->santriModel->whereIn('santri_id', $santri_id)->update([
            'status' => 'lulus',
            'tgl_keluar' => $data->tgl_keluar,
            'updated_at' => now(),
            'user_updated' => auth()->user()->user_id,
        ]);
        if (!$update) {
            return false;
        }
        return true;
    }
    /**
     * untuk menghapus daya santri , bisa multiple
     * @param array $santri_id
     * 
     * @return [type]
     */
    public function delete(array $santri_id)
    {
        DB::beginTransaction();
        $delete = $this->santriModel->whereIn('santri_id', $santri_id)->update([
            'user_deleted' => auth()->user()->user_id,
            'deleted_at' => now(),
            'deleted' => true,
            'user_updated' => null,
            'updated_at' => null
        ]);
        $deleteMonitoringBulanan = $this->monitoringBulananModel->whereIn('santri_id', $santri_id)->count();
        if ($deleteMonitoringBulanan > 0) {
            $deleteMonitoringBulanan = $this->monitoringBulananModel->whereIn('santri_id', $santri_id)->update([
                'deleted_at' => now(),
                'user_deleted' => auth()->user()->user_id,
                'deleted' => true,
                'user_updated' => null,
                'updated_at' => null
            ]);
        } else {
            $deleteMonitoringBulanan = true;
        }
        $deleteMonitoringMingguan = $this->monitoringMingguanModel->whereIn('santri_id', $santri_id)->count();
        if ($deleteMonitoringMingguan > 0) {
            $deleteMonitoringMingguan = $this->monitoringMingguanModel->whereIn('santri_id', $santri_id)->update([
                'deleted_at' => now(),
                'user_deleted' => auth()->user()->user_id,
                'deleted' => true,
                'user_updated' => null,
                'updated_at' => null
            ]);
        } else {
            $deleteMonitoringMingguan = true;
        }
        $deleteRelasi = $this->santriRelasiModel->whereIn('santri_id', $santri_id)->count();
        if ($deleteRelasi) {
            $deleteRelasi = $this->santriRelasiModel->whereIn('santri_id', $santri_id)->update([
                'deleted_at' => now(),
                'user_deleted' => auth()->user()->user_id,
                'deleted' => true,
                'user_updated' => null,
                'updated_at' => null
            ]);
        } else {
            $deleteRelasi = true;
        }
        DB::commit();
        if (!$delete || !$deleteRelasi || !$deleteMonitoringBulanan || !$deleteMonitoringMingguan) {
            DB::rollBack();
            return false;
        }
        return true;
    }



}