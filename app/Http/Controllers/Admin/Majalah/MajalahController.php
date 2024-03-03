<?php

namespace App\Http\Controllers\Admin\Majalah;

use App\Models\Majalah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\MajalahInterface;
use App\Http\Requests\Majalah\MajalahCreateRequest;
use App\Http\Requests\Majalah\MajalahUpdateRequest;

class MajalahController extends Controller
{
    //
    private $MajalahInterface;
    public function __construct(MajalahInterface $MajalahInterface)
    {
        $this->MajalahInterface = $MajalahInterface;
    }

    public function index()
    {
        $headerTitle = 'Majalah Addiya';
        $data = $this->MajalahInterface->getAll(paginate: 10);
        return view('admin.majalah.index', compact('headerTitle', 'data'));
    }
    public function create()
    {
        $headerTitle = 'Tambah Majalah';
        return view('admin.majalah.create', compact('headerTitle'));
    }
    public function store(MajalahCreateRequest $request)
    {
        $create = $this->MajalahInterface->createMajalah($request);
        if (isset($create['error']) && $create['error'] == true) {
            return redirect()->back()->with('toast_error', $create['message']);
        } else if ($create) {
            return redirect(route('majalah.index'))->with('toast_success', 'Berhasil menambah majalah');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil menambah majalah');
        }
    }
    public function edit(Majalah $id){
        $data = $id;
        $headerTitle = 'Ubah Data Majalah';
        return view('admin.majalah.edit', compact('data', 'headerTitle'));
    }
    public function update(MajalahUpdateRequest $request, Majalah $id)
    {
        $update = $this->MajalahInterface->updateMajalah($request, $id);
        if (isset($update['error']) && $update['error'] == true) {
            return redirect()->back()->with('toast_error', $update['message']);
        } else if ($update) {
            return redirect(route('majalah.index'))->with('toast_success', 'Berhasil memperbarui majalah');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil memperbarui majalah');
        }
    }

    public function delete(Majalah $id)
    {
        $delete = $this->MajalahInterface->deleteMajalah($id);
        if (isset($delete['error']) && $delete['error'] == true) {
            return redirect()->back()->with('toast_error', $delete['message']);
        } else if ($delete) {
            return redirect(route('majalah.index'))->with('toast_success', 'Berhasil menghapus majalah');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil menghapus majalah');
        }
    }
}
