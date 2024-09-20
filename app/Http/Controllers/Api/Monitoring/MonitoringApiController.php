<?php

namespace App\Http\Controllers\Api\Monitoring;

use App\Http\Controllers\Controller;
use App\Repositories\Hafalan\HafalanInterface;
use App\Repositories\MonitoringMingguan\MonitoringMingguanInterface;
use Illuminate\Http\Request;

class MonitoringApiController extends Controller
{
    private $monitoringInterface, $hafalan;
    public function __construct(MonitoringMingguanInterface $monitoringInterface, HafalanInterface $hafalan)
    {
        $this->monitoringInterface = $monitoringInterface;
        $this->hafalan = $hafalan;
    }

    public function monitoring(Request $request)
    {
        //kategori ngaji / sholat jamaah
        $kategori = $request->kategori ?? 'sholat jamaah';
        $santriId = $request->santriId;
        $paginate = $request->paginate ?? 10;
        $data = $this->monitoringInterface->getAllwhereSantri(kategori: $kategori, santriId: $santriId, paginate: $paginate);
        return $data;
    }
    public function hafalan(Request $request)
    {
        $santriId = $request->santriId;
        $paginate = $request->paginate ?? 10;
        $data = $this->hafalan->getAllWhereSantri(santriId: $santriId, paginate: $paginate);
        return $data;
    }
}
