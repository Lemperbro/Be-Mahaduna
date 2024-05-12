<?php

namespace App\Http\Controllers\Admin\Kelas;

use App\Http\Controllers\Controller;
use App\Models\Jenjang;
use App\Repositories\Jenjang\JenjangInterface;
use App\Repositories\Santri\SantriInterface;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    private $jenjangInterface;
    public function __construct(JenjangInterface $jenjangInterface)
    {
        $this->jenjangInterface = $jenjangInterface;
    }

    public function index()
    {
        $data = $this->jenjangInterface->getAll();
        $headerTitle = 'Kelola Kelas';
        return view('admin.kelas.index', compact('headerTitle', 'data'));
    }
    public function create(Request $request)
    {
        $validate = $request->validate([
            'kelas' => 'required'
        ]);
        if (!$validate) {
            return redirect()->back()->with('toast_error', 'Gagal, mohon periksa data inputan anda');
        }
        $create = $this->jenjangInterface->tambahKelas($request);
        if ($create) {
            return redirect()->back()->with('toast_success', 'berhasil menambah kelas');
        } else {
            return redirect()->back()->with('toast_error', 'tidak berhasil menambah kelas');
        }
    }
    public function update(Request $request, Jenjang $id)
    {
        $validate = $request->validate([
            'kelas' => 'required'
        ]);
        if (!$validate) {
            return redirect()->back()->with('toast_error', 'Gagal, mohon periksa data inputan anda');
        }
        $update = $this->jenjangInterface->updateDataKelas($request, $id);
        if ($update) {
            return redirect()->back()->with('toast_success', 'berhasil mengubah kelas');
        } else {
            return redirect()->back()->with('toast_error', 'tidak berhasil mengubah kelas');
        }
    }
    public function delete(Jenjang $id)
    {
        $id->update([
            'user_deleted' => auth()->user()->user_id,
            'deleted' => true
        ]);
        $hapus = $id->delete();
        if ($hapus) {
            return redirect()->back()->with('toast_success', 'berhasil menghapus kelas');
        } else {
            return redirect()->back()->with('toast_error', 'tidak berhasil menghapus kelas');
        }
    }

}
