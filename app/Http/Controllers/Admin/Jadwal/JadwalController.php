<?php

namespace App\Http\Controllers\Admin\Jadwal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\JadwalInterface;

class JadwalController extends Controller
{
    
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
