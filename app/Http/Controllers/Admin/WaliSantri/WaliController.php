<?php

namespace App\Http\Controllers\Admin\WaliSantri;

use App\Models\Wali;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Wali\WaliInterface;
use App\Http\Requests\WaliWaliCreateRequest;
use App\Http\Requests\Wali\WaliCreateRequest;
use App\Http\Requests\Wali\WaliDeleteRequest;
use App\Http\Requests\Wali\WaliUpdateRequest;

class WaliController extends Controller
{
    private $WaliInterface;
    public function __construct(WaliInterface $WaliInterface)
    {
        $this->WaliInterface = $WaliInterface;
    }

    public function index()
    {
        $headerTitle = 'Kelola Wali Santri';
        $paginate = 25;
        $keyword = request('keyword') ?? null;
        $data = $this->WaliInterface->getAll(paginate: $paginate, keyword: $keyword);
        $totalShowData = $data->total();
        return view('admin.wali-santri.index', compact('headerTitle', 'data', 'totalShowData'));
    }
    public function showSantri($wali_id)
    {
        $data = $this->WaliInterface->showSantri($wali_id);
        $headerTitle = 'Putra - Putri';
        return view('admin.wali-santri.showSantri', compact('headerTitle', 'data'));
    }
    public function create()
    {
        $headerTitle = 'Tambah data wali';
        return view('admin.wali-santri.create', compact('headerTitle'));
    }
    public function store(WaliCreateRequest $request)
    {
        $create = $this->WaliInterface->create($request);
        if (isset($create['error']) && $create['error'] == true) {
            return redirect()->back()->with('toast_error', $create['message']);
        } else if ($create) {
            return redirect(route('wali.index'))->with('toast_success', 'Berhasil menambah data');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil menambah data');
        }
    }
    public function edit(Wali $id)
    {
        $headerTitle = 'Ubah data wali santri';
        $data = $id;
        return view('admin.wali-santri.edit', compact('headerTitle', 'data'));
    }
    public function update(WaliUpdateRequest $request, Wali $id)
    {
        $update = $this->WaliInterface->update($request, $id);
        if (isset($update['error']) && $update['error'] == true) {
            return redirect()->back()->with('toast_error', $update['message']);
        } else if ($update) {
            return redirect(route('wali.index'))->with('toast_success', 'Berhasil memperbarui data');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil memperbarui data');
        }
    }
    public function delete(WaliDeleteRequest $request)
    {
        $delete = $this->WaliInterface->delete($request->wali_id);
        if (isset($delete['error']) && $delete['error'] == true) {
            return redirect()->back()->with('toast_error', $delete['message']);
        } else if ($delete) {
            return redirect()->back()->with('toast_success', 'Berhasil menghapus data');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil menghapus data');
        }
    }
}
