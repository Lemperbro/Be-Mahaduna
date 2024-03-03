<?php
namespace App\Repositories;

use App\Http\Resources\Jadwal\JadwalResource;
use App\Models\Jadwal;
use App\Repositories\Interfaces\JadwalInterface;

class JadwalRepository implements JadwalInterface
{

    private $jadwalModal;
    public function __construct()
    {
        $this->jadwalModal = new Jadwal;

    }
    /**
     * untuk mengambil semua data jadwal
     * @return [type]
     */
    public function getAll()
    {
        $data = $this->jadwalModal->orderBy('start_time', 'asc')->get();
        if (request()->wantsJson()) {
            return(JadwalResource::collection($data))->response()->setStatusCode(200);
        } else {
            return $data;
        }
    }

}