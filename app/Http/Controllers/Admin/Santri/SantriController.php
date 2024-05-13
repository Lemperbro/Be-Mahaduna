<?php

namespace App\Http\Controllers\Admin\Santri;

use App\Models\Santri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Wali\WaliInterface;
use App\Repositories\Santri\SantriInterface;
use App\Repositories\Jenjang\JenjangInterface;
use App\Http\Requests\Santri\SantriLulusRequest;
use App\Http\Requests\Santri\SantriCreateRequest;
use App\Http\Requests\Santri\SantriDeleteRequest;
use App\Http\Requests\Santri\SantriUbahKelasRequest;

class SantriController extends Controller
{
    private $SantriInterface, $JenjangInterface, $WaliInterface;

    public function __construct(SantriInterface $SantriInterface, JenjangInterface $JenjangInterface, WaliInterface $WaliInterface)
    {
        $this->SantriInterface = $SantriInterface;
        $this->JenjangInterface = $JenjangInterface;
        $this->WaliInterface = $WaliInterface;
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
    public function create()
    {
        $headerTitle = 'Tambah Santri';
        $jenjang = $this->JenjangInterface->getAll();
        $wali = $this->WaliInterface->getAll();
        return view('admin.santri.create', compact('headerTitle', 'jenjang', 'wali'));
    }
    public function store(SantriCreateRequest $request)
    {
        $create = $this->SantriInterface->create($request);
        if (isset($create['error']) && $create['error'] == true) {
            return redirect()->back()->with('toast_error', $create['message']);
        } else if ($create) {
            return redirect(route('santri.index'))->with('toast_success', 'Berhasil menambah data');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil menambah data');
        }
    }
    public function toLulus(SantriLulusRequest $request){
        $update = $this->SantriInterface->toLulus($request);
        if (isset($update['error']) && $update['error'] == true) {
            return redirect()->back()->with('toast_error', $update['message']);
        } else if ($update) {
            return redirect()->back()->with('toast_success', 'Berhasil merubah status santri');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil merubah status santri');
        }
    }
    public function ubahKelas(SantriUbahKelasRequest $request){
        $update = $this->SantriInterface->ubahKelas($request);
        if (isset($update['error']) && $update['error'] == true) {
            return redirect()->back()->with('toast_error', $update['message']);
        } else if ($update) {
            return redirect()->back()->with('toast_success', 'Berhasil merubah kelas santri');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil merubah kelas santri');
        }
    }
    public function delete(SantriDeleteRequest $request)
    {
        $delete = $this->SantriInterface->delete($request->santri_id);
        // dd($delete);
        if (isset($delete['error']) && $delete['error'] == true) {
            return redirect()->back()->with('toast_error', $delete['message']);
        } else if ($delete) {
            return redirect()->back()->with('toast_success', 'Berhasil menghapus data');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil menghapus data');
        }
    }
}
