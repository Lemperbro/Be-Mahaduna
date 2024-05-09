<?php

namespace App\Http\Controllers\Api\Jadwal;

use App\Http\Controllers\Controller;
use App\Repositories\Jadwal\JadwalInterface;
use Illuminate\Http\Request;

class JadwalApiController extends Controller
{
    private $JadwalInterface;
    public function __construct(JadwalInterface $jadwalInterface)
    {
        $this->JadwalInterface = $jadwalInterface;
    }

    public function all()
    {
        $data = $this->JadwalInterface->getAll();
        return $data;
    }
}
