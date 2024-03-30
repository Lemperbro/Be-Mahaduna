<?php

namespace App\Http\Controllers\Admin\Store;

use App\Models\Store;
use App\Models\StoreImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Repositories\Store\StoreInterface;
use App\Http\Requests\Store\StoreCreateRequest;
use App\Http\Requests\Store\StoreUpdateRequest;

class StoreController extends Controller
{
    private $StoreInterface;

    public function __construct(StoreInterface $storeInterface)
    {
        $this->StoreInterface = $storeInterface;
    }

    public function index()
    {
        $headerTitle = 'Kelola Store';
        $data = $this->StoreInterface->getAllProduk();
        return view('admin.store.index', compact('headerTitle', 'data'));
    }
    public function create()
    {
        $headerTitle = 'Tambah Produk';
        return view('admin.store.create', compact('headerTitle'));
    }
    public function store(StoreCreateRequest $request)
    {
        $create = $this->StoreInterface->create($request);
        if (isset($create['error']) && $create['error'] == true) {
            return redirect()->back()->with('toast_error', $create['message']);
        } else if ($create) {
            return redirect(route('store.index'))->with('toast_success', 'Berhasil Menambah Produk');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil menambah produk');
        }
    }
    public function edit(Store $id)
    {
        $data = $id->load('store_image');
        $headerTitle = 'Ubah Produk';
        return view('admin.store.edit', compact('data', 'headerTitle'));
    }
    public function update(StoreUpdateRequest $request, Store $id)
    {
        $oldData = $id;
        $data = $request;
        $update = $this->StoreInterface->update($data, $oldData);
        if (isset($update['error']) && $update['error'] == true) {
            return redirect()->back()->with('toast_error', $update['message']);
        } else if ($update) {
            return redirect(route('store.index'))->with('toast_success', 'Berhasil Memperbarui Produk');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil memperbarui produk');
        }
    }
    public function delete(Store $id)
    {
        $delete = $this->StoreInterface->delete($id);
        if (isset($delete['error']) && $delete['error'] == true) {
            return redirect()->back()->with('toast_error', $delete['message']);
        } else if ($delete) {
            return redirect(route('store.index'))->with('toast_success', 'Berhasil Menghapus Produk');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil menghapus produk');
        }
    }

    public function filePondImageDelete(Request $request, $folder)
    {
        $fileName = basename($request->input('imageName'));
        $filePath = public_path("uploads/$folder/$fileName");
        $count = StoreImage::where('store_id', $request->input('store_id'))->count();
        if ($count > 1) {
            $delete = StoreImage::where('store_id', $request->input('store_id'))->where('image', $request->input('imageName'))->forceDelete();
            if ($delete) {
                if (File::exists($filePath)) {
                    File::delete($filePath);
                    return response()->json(['message' => 'File deleted successfully']);
                }
            } else {
                return response()->json(['error' => 'File not found'], 400);
            }
        } else {
            return response()->json(['error' => 'image update harus menyisahkan 1'], 400);
        }
    }
}
