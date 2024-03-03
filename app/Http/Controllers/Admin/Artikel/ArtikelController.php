<?php

namespace App\Http\Controllers\Admin\Artikel;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ArtikelInterface;
use App\Http\Requests\Artikel\ArtikelCreateRequest;
use App\Http\Requests\Artikel\ArtikelUpdateRequest;
use App\Http\Requests\Artikel\KategoriCreateRequest;
use App\Http\Requests\Artikel\KategoriUpdateRequest;
use App\Models\Artikel;
use App\Models\ArtikelKategori;

class ArtikelController extends Controller
{
    //

    private $ArtikelInterface;

    public function __construct(ArtikelInterface $ArtikelInterface)
    {
        $this->ArtikelInterface = $ArtikelInterface;
    }


    public function index()
    {
        $headerTitle = 'Kelola Artikel';
        $keyword = request('keyword') ?? null;
        $sortBest = request('sortBest') ?? false;
        $useForApi = false;
        $allArtikel = $this->ArtikelInterface->getAllArtikel(20, $keyword, $sortBest, $useForApi);
        return view('admin.artikel.index', compact('headerTitle', 'allArtikel'));
    }

    public function artikelCreateIndex()
    {
        $headerTitle = 'Buat Artikel';
        $kategori = $this->ArtikelInterface->getAllKategori(null);
        return view('admin.artikel.create', compact('headerTitle', 'kategori'));
    }

    public function artikelCreate(ArtikelCreateRequest $request)
    {
        $create = $this->ArtikelInterface->createArtikel($request);
        if (isset($create['error']) && $create['error'] == true) {
            return redirect()->back()->with('toast_error', $create['message']);
        } else if ($create) {
            return redirect(route('artikel.index'))->with('toast_success', 'Berhasil Membuat Artikel');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil membuat artikel');
        }
    }

    public function artikelEdit(Artikel $id)
    {
        $data = $id->load('artikel_relasi.artikel_kategori');
        $kategori = $this->ArtikelInterface->getAllKategori(null);
        return view('admin.artikel.edit', compact('data', 'kategori'));
    }
    public function artikelUpdate(ArtikelUpdateRequest $request, Artikel $id)
    {
        $oldData = $id;
        $data = $request;
        $update = $this->ArtikelInterface->updateArtikel($data, $oldData);
        if (isset($update['error']) && $update['error'] == true) {
            return redirect()->back()->with('toast_error', $update['message']);
        } else if ($update) {
            return redirect(route('artikel.index'))->with('toast_success', 'Berhasil Memperbarui Artikel');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil Memperbarui Artikel');
        }
    }
    public function deleteArtikel(Artikel $id)
    {
        $delete = $this->ArtikelInterface->deleteArtikel($id);
        if (isset($delete['error']) && $delete['error'] == true) {
            return redirect()->back()->with('toast_error', $delete['message']);
        } else if ($delete) {
            return redirect(route('artikel.index'))->with('toast_success', 'Berhasil Menghapus Artikel');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil Menghapus Artikel');
        }
    }


    // kategori artikel area
    public function kategoriIndex()
    {
        $headerTitle = 'Kelola Kategori Artikel';
        $allKategori = $this->ArtikelInterface->getAllKategori(15);
        return view('admin.artikel.kategori.index', compact('headerTitle', 'allKategori'));
    }
    public function kategoriCreate(KategoriCreateRequest $request)
    {
        $create = $this->ArtikelInterface->createKategori($request);
        if (isset($create['error']) && $create['error'] == true) {
            return redirect()->back()->with('toast_error', $create['message']);
        } else if ($create) {
            return redirect(route('artikel.kategori.index'))->with('toast_success', 'Berhasil Menambah Kategori');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil Menambah Kategori');
        }
    }
    public function kategoriUpdate(KategoriUpdateRequest $request, ArtikelKategori $id)
    {
        $update = $this->ArtikelInterface->updateKategori($request, $id);
        if (isset($update['error']) && $update['error'] == true) {
            return redirect()->back()->with('toast_error', $update['message']);
        } else if ($update) {
            return redirect(route('artikel.kategori.index'))->with('toast_success', 'Berhasil Mengubah Kategori');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil Mengubah Kategori');
        }
    }

    public function deleteKategori(ArtikelKategori $id)
    {
        $delete = $this->ArtikelInterface->deleteKategori($id);
        if (isset($delete['error']) && $delete['error'] == true) {
            return redirect()->back()->with('toast_error', $delete['message']);
        } else if ($delete) {
            return redirect(route('artikel.kategori.index'))->with('toast_success', 'Berhasil Menghapus Kategori');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil Menghapus Kategori');
        }
    }


}
