<?php

namespace App\Http\Controllers\Admin\MonitoringMingguan;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\MonitorMingguan;
use App\Http\Controllers\Controller;
use App\Repositories\Santri\SantriInterface;
use App\Repositories\Jenjang\JenjangInterface;
use App\Http\Requests\MonitoringMingguan\DeleteDataMultipleRequest;
use App\Repositories\MonitoringMingguan\MonitoringMingguanInterface;
use App\Http\Requests\MonitoringMingguan\CreateMonitorMingguanRequest;
use App\Http\Requests\MonitoringMingguan\UpdateMonitoringMingguanRequest;

class MonitoringMingguanController extends Controller
{
    private $MonitoringMingguanInterface, $JenjangInterface, $SantriInterface;
    public function __construct(MonitoringMingguanInterface $MonitoringMingguanInterface, JenjangInterface $JenjangInterface, SantriInterface $SantriInterface)
    {
        $this->MonitoringMingguanInterface = $MonitoringMingguanInterface;
        $this->JenjangInterface = $JenjangInterface;
        $this->SantriInterface = $SantriInterface;
    }

    public function monitoringSholatIndex()
    {
        $headerTitle = 'Kelola Monitoring Sholat Jamaah';
        $kategori = 'sholat jamaah';
        $paginate = 20;
        $keyword = request('keyword') ?? null;
        $tahun = request('tahun') ?? null;
        $jenjang_id = request('jenjang') ?? null;
        $data = $this->MonitoringMingguanInterface->getAll(kategori: $kategori, paginate: $paginate, keyword: $keyword, tahun: $tahun, jenjang_id: $jenjang_id);
        $totalShowData = $data->total();
        $dataJenjang = $this->JenjangInterface->getAll();
        return view('admin.Monitoring-Sholat.index', compact('headerTitle', 'data', 'totalShowData', 'dataJenjang'));
    }

    public function monitoringNgajiIndex()
    {
        $headerTitle = 'Kelola Monitoring Ngaji';
        $kategori = 'ngaji';
        $paginate = 20;
        $keyword = request('keyword') ?? null;
        $tahun = request('tahun') ?? null;
        $jenjang_id = request('jenjang') ?? null;
        $data = $this->MonitoringMingguanInterface->getAll(kategori: $kategori, paginate: $paginate, keyword: $keyword, tahun: $tahun, jenjang_id: $jenjang_id);
        $totalShowData = $data->total();
        $dataJenjang = $this->JenjangInterface->getAll();
        return view('admin.Monitoring-Ngaji.index', compact('headerTitle', 'data', 'totalShowData', 'dataJenjang'));
    }
    public function create($type)
    {
        $headerTitle = 'Tambah data monitoring ' . ($type === 'sholat' ? 'sholat jamaah' : 'ngaji');
        $santri = $this->SantriInterface->getAll();
        return view('admin.Monitoring-Sholat.tambahData', compact('headerTitle', 'santri', 'type'));
    }
    public function store(CreateMonitorMingguanRequest $request, $type)
    {
        $create = $this->MonitoringMingguanInterface->store($request, $type);
        if (isset ($create['error']) && $create['error'] == true) {
            return redirect()->back()->with('toast_error', $create['message']);
        } else if ($create) {
            return redirect($type === 'sholat' ? route('monitoring.sholat.index') : route('monitoring.ngaji.index'))->with('toast_success', 'Berhasil menambah data monitoring');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil menambah data monitoring');
        }
    }
    public function edit($type, MonitorMingguan $id)
    {
        $headerTitle = 'Tambah data monitoring ' . ($type === 'sholat' ? 'sholat jamaah' : 'ngaji');
        $data = $id->load('santri');
        return view('admin.Monitoring-Sholat.editData', compact('headerTitle', 'data', 'type'));
    }
    public function update(UpdateMonitoringMingguanRequest $request, $type, MonitorMingguan $id)
    {
        $update = $this->MonitoringMingguanInterface->update($request, $id->load('santri'));
        if (isset ($update['error']) && $update['error'] == true) {
            return redirect()->back()->with('toast_error', $update['message']);
        } else if ($update) {
            return redirect($type === 'sholat' ? route('monitoring.sholat.index') : route('monitoring.ngaji.index'))->with('toast_success', 'Berhasil mengubah data');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil mengubah data');
        }
    }
    public function deleteDataMultiple(DeleteDataMultipleRequest $request, $type)
    {
        $delete = $this->MonitoringMingguanInterface->deleteDataMultiple($request->monitor_mingguan_id_delete_multiple, $type);
        if (isset ($delete['error']) && $delete['error'] == true) {
            return redirect()->back()->with('toast_error', $delete['message']);
        } else if ($delete) {
            return redirect($type === 'sholat' ? route('monitoring.sholat.index') : route('monitoring.ngaji.index'))->with('toast_success', 'Berhasil menghapus data');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil menghapus data');
        }
    }
}
