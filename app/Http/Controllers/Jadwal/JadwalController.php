<?php

namespace App\Http\Controllers\Jadwal;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\JadwalInterface;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    //
    private $JadwalInterface;

    public function __construct(JadwalInterface $JadwalInterface){
        $this->JadwalInterface = $JadwalInterface;
    }

    public function index(){
        $headerTitle = 'Kelola Jadwal Santri';
        $data = $this->JadwalInterface->getAll();
        return view('admin.jadwal.index', compact('headerTitle','data'));
    }
}
