<?php

namespace App\Http\Controllers\Admin\Pembayaran;

use App\Models\Tagihan;
use App\Exports\TagihanExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Repositories\Santri\SantriInterface;
use App\Repositories\Jenjang\JenjangInterface;
use App\Repositories\Tagihan\TagihanInterface;
use App\Repositories\Transaksi\TransaksiInterface;
use App\Http\Requests\Tagihan\TagihanCreateRequest;
use App\Http\Requests\Tagihan\TagihanUpdateRequest;
use App\Http\Requests\Tagihan\TagihanKonfirmRequest;
use App\Http\Requests\Tagihan\TagihanDeleteMultipleRequest;

class PembayaranController extends Controller
{
    //
    private $TagihanInterface, $SantriInterface, $TransaksiInterface, $JenjangInterface;

    public function __construct(TagihanInterface $TagihanInterface, SantriInterface $SantriInterface, TransaksiInterface $TransaksiInterface, JenjangInterface $JenjangInterface)
    {
        $this->TagihanInterface = $TagihanInterface;
        $this->SantriInterface = $SantriInterface;
        $this->TransaksiInterface = $TransaksiInterface;
        $this->JenjangInterface = $JenjangInterface;
    }
    public function index()
    {
        $headerTitle = 'Kelola Pembayaran';
        $jenjang = $this->JenjangInterface->getAll();
        $bulan = request('bulan') ?? null;
        $tahun = request('tahun') ?? null;
        $status = request('status') ?? null;
        $keyword = request('search') ?? null;
        $kelas = request('jenjang') ?? null;
        $data = $this->TagihanInterface->getAllTagihan(paginate: 50, bulan: $bulan, kelas: $kelas, tahun: $tahun, status: $status, keyword: $keyword);
        $totalShowData = $data->total();
        $totalData = $this->TagihanInterface->countAll();
        $totalTagihanBelumDibayar = $this->TagihanInterface->countTagihanBelumBayar();
        $totalTagihanSudahDibayar = $this->TagihanInterface->countTagihanSudahDibayar();
        $pendapatanTahunIni = $this->TagihanInterface->moneyInYear();
        if (request('download') == true) {
            $export = $this->TagihanInterface->getAllTagihan(paginate: null, bulan: $bulan, kelas: $kelas, tahun: $tahun, status: $status, keyword: $keyword);
            return $this->export($export, route('kelola-pembayaran.index'));
        }
        return view('admin.kelola-pembayaran.index', compact('headerTitle', 'data', 'totalShowData', 'totalData', 'totalTagihanBelumDibayar', 'totalTagihanSudahDibayar', 'pendapatanTahunIni', 'jenjang'));
    }

    public function indexNunggak()
    {
        $headerTitle = 'Daftar Tunggakan';
        $keyword = request('keyword') ?? null;
        $kelas = request('jenjang') ?? null;
        $data = $this->TagihanInterface->getAllTunggakan(paginate: 20, keyword: $keyword, kelas: $kelas);
        $showTotal = $data->total();
        $jenjang = $this->JenjangInterface->getAll();
        if (request('download') == true) {
            $export = $this->TagihanInterface->getAllTunggakan(paginate: null, keyword: $keyword, kelas: $kelas, grup: false);
            return $this->export($export, route('kelola-pembayaran.tunggakan'));
        }
        return view('admin.kelola-pembayaran.daftarNunggak.index', compact('headerTitle', 'data', 'showTotal', 'jenjang'));
    }

    public function createTagihan()
    {
        $headerTitle = 'Buat Tagihan';
        $tahunMasuk = request('tahun') ?? null;
        $jenisKelamin = request('jenis_kelamin') ?? null;
        $jenjang = request('jenjang') ?? null;
        $dataJenjang = $this->JenjangInterface->getAll();
        $data = $this->SantriInterface->getAll(tahunMasuk: $tahunMasuk, jenisKelamin: $jenisKelamin, jenjang: $jenjang);
        return view('admin.kelola-pembayaran.buat-tagihan.index', compact('headerTitle', 'data', 'dataJenjang'));
    }

    public function storeTagihan(TagihanCreateRequest $request)
    {
        // dd($request->all());
        $create = $this->TagihanInterface->createTagihan($request);
        if (isset($create['error']) && $create['error'] == true) {
            return redirect()->back()->with('toast_error', $create['message']);
        } else if ($create) {
            return redirect(route('kelola-pembayaran.index'))->with('toast_success', 'Berhasil menambah tagihan');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil menambah tagihan');
        }
    }
    public function edit(Tagihan $id)
    {
        $checkIsPending = $this->TransaksiInterface->checkTransaksiIsPending($id->tagihan_id);
        if ($checkIsPending) {
            return redirect()->back()->with('toast_error', 'Mohon maaf tidak dapat merubah tagihan, Transaksi sedang berjalan');
        }
        $data = $id;
        $headerTitle = 'Ubah Tagihan';
        return view('admin.kelola-pembayaran.edit-tagihan.index', compact('headerTitle', 'data'));
    }
    public function updateTagihan(TagihanUpdateRequest $request, Tagihan $id)
    {
        $update = $this->TagihanInterface->updateTagihan($request, $id);
        if (isset($update['error']) && $update['error'] == true) {
            return redirect()->back()->with('toast_error', $update['message']);
        } else if ($update) {
            return redirect(route('kelola-pembayaran.index'))->with('toast_success', 'Berhasil memperbarui tagihan');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil memperbarui tagihan');
        }
    }
    public function konfirmasiTagihan(TagihanKonfirmRequest $request, Tagihan $id)
    {
        $konfirm = $this->TagihanInterface->konfirmasiTagihan($request->payment_type, $id);
        if (isset($konfirm['error']) && $konfirm['error'] == true) {
            return redirect()->back()->with('toast_error', $konfirm['message']);
        } else if ($konfirm) {
            return redirect(route('kelola-pembayaran.index'))->with('toast_success', 'Berhasil konfirmasi tagihan');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil konfirmasi tagihan');
        }
    }
    public function deleteTagihan(Tagihan $id)
    {
        $delete = $this->TagihanInterface->deleteTagihan($id);
        if (isset($delete['error']) && $delete['error'] == true) {
            return redirect()->back()->with('toast_error', $delete['message']);
        } else if ($delete) {
            return redirect(route('kelola-pembayaran.index'))->with('toast_success', 'Berhasil menghapus tagihan');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil menghapus tagihan');
        }
    }
    public function deleteTagihanMultiple(TagihanDeleteMultipleRequest $request)
    {
        $deleteMultiple = $this->TagihanInterface->deleteTagihanMultiple($request->tagihan_id_delete_multiple);
        if (isset($deleteMultiple['error']) && $deleteMultiple['error'] == true) {
            return redirect()->back()->with('toast_error', $deleteMultiple['message']);
        } else if ($deleteMultiple) {
            return redirect(route('kelola-pembayaran.index'))->with('toast_success', 'Berhasil menghapus tagihan');
        } else {
            return redirect()->back()->with('toast_error', 'Tidak berhasil menghapus tagihan');
        }
    }

    public function export($data, $routeBack)
    {
        try {
            return redirect($routeBack);
        } finally {
            return Excel::download(new TagihanExport($data), 'tagihan.xlsx');

        }
    }
}
