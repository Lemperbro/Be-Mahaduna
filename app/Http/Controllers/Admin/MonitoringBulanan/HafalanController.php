<?php

namespace App\Http\Controllers\Admin\MonitoringBulanan;

use App\Exports\HafalanExport;
use App\Models\MonitorBulanan;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\Santri\SantriInterface;
use App\Repositories\Jenjang\JenjangInterface;
use App\Repositories\Hafalan\HafalanRepository;
use App\Http\Requests\Hafalan\HafalanCreateRequest;
use App\Http\Requests\Hafalan\HafalanDeleteRequest;
use App\Http\Requests\Hafalan\HafalanUpdateRequest;

class HafalanController extends Controller
{
    private $HafalanInterface, $JenjangInterface, $SantriInterface;
    public function __construct(HafalanRepository $HafalanInterface, JenjangInterface $JenjangInterface, SantriInterface $SantriInterface)
    {
        $this->HafalanInterface = $HafalanInterface;
        $this->JenjangInterface = $JenjangInterface;
        $this->SantriInterface = $SantriInterface;
    }

    public function index()
    {
        $headerTitle = 'Kelola monitoring hafalan';
        $paginate = 20;
        $keyword = request('keyword') ?? null;
        $tahun = request('tahun') ?? null;
        $jenjang_id = request('jenjang') ?? null;
        $bulan = request('bulan') ?? null;
        $data = $this->HafalanInterface->getAll(paginate: $paginate, keyword: $keyword, tahun: $tahun, jenjang_id: $jenjang_id, bulan: $bulan);
        $totalShowData = $data->total();
        $dataJenjang = $this->JenjangInterface->getAll();
        if (request('download') == true) {
            $export = $this->HafalanInterface->getAll(paginate: null, keyword: $keyword, tahun: $tahun, jenjang_id: $jenjang_id, bulan: $bulan);
            return $this->export($export, route('monitoring.hafalan'));
        }
        return view('admin.hafalan.index', compact('headerTitle', 'data', 'dataJenjang', 'totalShowData'));
    }
    public function create()
    {
        $headerTitle = 'Tambah data hafalan';
        $santri = $this->SantriInterface->getAll();
        return view('admin.hafalan.create', compact('headerTitle', 'santri'));
    }
    public function store(HafalanCreateRequest $request)
    {
        $create = $this->HafalanInterface->create($request);
        if (isset($create['error']) && $create['error'] == true) {
            return redirect()->back()->with('toast_error', $create['message']);
        } else if ($create) {
            return redirect()->back()->with('toast_success', 'Berhasil menambah data');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil menambah data');
        }
    }
    public function edit(MonitorBulanan $id)
    {
        $headerTitle = 'Ubah data hafalan';
        $data = $id;
        return view('admin.hafalan.edit', compact('headerTitle', 'data'));
    }
    public function update(HafalanUpdateRequest $request, MonitorBulanan $id)
    {
        $update = $this->HafalanInterface->update($request, $id);
        if (isset($update['error']) && $update['error'] == true) {
            return redirect()->back()->with('toast_error', $update['message']);
        } else if ($update) {
            return redirect(route('monitoring.hafalan'))->with('toast_success', 'Berhasil memperbarui data');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil memperbarui data');
        }
    }
    public function delete(HafalanDeleteRequest $request)
    {
        $delete = $this->HafalanInterface->delete($request->hafalan_id);
        if (isset($delete['error']) && $delete['error'] == true) {
            return redirect()->back()->with('toast_error', $delete['message']);
        } else if ($delete) {
            return redirect()->back()->with('toast_success', 'Berhasil menghapus data');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil menghapus data');
        }
    }

    public function export($data, $routeBack)
    {
        try {
            return redirect($routeBack);
        } finally {
            return Excel::download(new HafalanExport($data), 'data-hafalan-santri.xlsx');
        }
    }
}
