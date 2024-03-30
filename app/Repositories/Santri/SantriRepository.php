<?php
namespace App\Repositories\Santri;

use App\Models\Santri;
use App\Repositories\Santri\SantriInterface;
use App\Http\Resources\Santri\SantriResource;

class SantriRepository implements SantriInterface
{
    private $santriModel;
    public function __construct()
    {
        $this->santriModel = new Santri;
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
        $data = $this->santriModel->with('jenjang', 'waliRelasi.wali');
        if ($keyword !== null) {
            $data->where('nama', 'like', '%' . $keyword . '%');
        }
        if ($tahunMasuk !== null) {
            $data->whereYear('tgl_masuk', $tahunMasuk);
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
}