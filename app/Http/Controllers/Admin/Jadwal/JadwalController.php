<?php

namespace App\Http\Controllers\Admin\Jadwal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Jadwal\JadwalCreateRequest;
use App\Repositories\Interfaces\JadwalInterface;

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
}
