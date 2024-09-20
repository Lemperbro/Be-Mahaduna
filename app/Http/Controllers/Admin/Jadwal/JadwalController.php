<?php

namespace App\Http\Controllers\Admin\Jadwal;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Jadwal\JadwalInterface;
use App\Http\Requests\Jadwal\JadwalCreateRequest;
use App\Http\Requests\Jadwal\JadwalUpdateRequest;

class JadwalController extends Controller
{

    private $JadwalInterface;

    public function __construct(JadwalInterface $JadwalInterface)
    {
        $this->JadwalInterface = $JadwalInterface;
    }

    public function index()
    {
        $headerTitle = 'Kelola Jadwal Santri';
        $data = $this->JadwalInterface->getAll();
        return view('admin.jadwal.index', compact('headerTitle', 'data'));
    }
    public function store(JadwalCreateRequest $request)
    {
        $create = $this->JadwalInterface->create($request);
        if (isset($create['error']) && $create['error'] == true) {
            return redirect()->back()->with('toast_error', $create['message']);
        } else if ($create) {
            return redirect(route('jadwal.index'))->with('toast_success', 'Berhasil Menambah Jadwal');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil Menambah Jadwal');
        }
    }
    public function update(JadwalUpdateRequest $request, Jadwal $id)
    {
        $update = $this->JadwalInterface->update($request, $id);
        if (isset($update['error']) && $update['error'] == true) {
            return redirect()->back()->with('toast_error', $update['message']);
        } else if ($update) {
            return redirect(route('jadwal.index'))->with('toast_success', 'Berhasil Memperbarui Jadwal');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil Memperbarui Jadwal');
        }
    }
    public function delete(Jadwal $id)
    {
        $delete = $this->JadwalInterface->delete($id);
        if (isset($delete['error']) && $delete['error'] == true) {
            return redirect()->back()->with('toast_error', $delete['message']);
        } else if ($delete) {
            return redirect(route('jadwal.index'))->with('toast_success', 'Berhasil menghapus jadwal');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil menghapus jadwal');
        }
    }
}
