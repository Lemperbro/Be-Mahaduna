<?php

namespace App\Http\Controllers\Admin\Santri;

use App\Http\Controllers\Controller;
use App\Repositories\Jenjang\JenjangInterface;
use App\Repositories\Santri\SantriInterface;
use Illuminate\Http\Request;

class SantriController extends Controller
{
    private $SantriInterface, $JenjangInterface;

    public function __construct(SantriInterface $SantriInterface, JenjangInterface $JenjangInterface)
    {
        $this->SantriInterface = $SantriInterface;
        $this->JenjangInterface = $JenjangInterface;
    }

    public function index()
    {
        $headerTitle = 'Kelola Santri';
        $jenjang = $this->JenjangInterface->getAll();
        $paginate = 25;
        $tahun = request('tahun') ?? null;
        $keyword = request('keyword') ?? null;
        $jenjang_id = request('jenjang') ?? null;
        $status = request('status') ?? null;
        $jenis_kelamin = request('jenis_kelamin') ?? null;
        $data = $this->SantriInterface->getAll(paginate: $paginate, keyword: $keyword, tahunMasuk: $tahun, jenjang: $jenjang_id, status: $status, jenisKelamin: $jenis_kelamin);
        $dataTotal = $data->total();
        return view('admin.santri.index', compact('headerTitle', 'data', 'dataTotal', 'jenjang'));
    }
}
