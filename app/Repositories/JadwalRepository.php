<?php
namespace App\Repositories;

use Exception;
use Carbon\Carbon;
use App\Models\Jadwal;
use App\Http\Resources\Jadwal\JadwalResource;
use App\Repositories\ResponseErrorRepository;
use App\Repositories\Interfaces\JadwalInterface;

class JadwalRepository implements JadwalInterface
{

    private $jadwalModal;
    private $handleResponseError;
    public function __construct()
    {
        $this->jadwalModal = new Jadwal;
        $this->handleResponseError = new ResponseErrorRepository;


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
    /**
     * untuk menambah data jadwal
     * @param mixed $data data yang akan disimpan ke database
     * 
     * @return [type]
     */
    public function create($data)
    {
        try {
            //cek data jadwal dengan jam tersebut sudah terisi apa belum
            $cekData = $this->jadwalModal->where('start_time', '<=', $data->endTime)->where('end_time', '>=', $data->startTime)->count();
            // dd($cekData);
            if ($cekData > 0) {
                $startTimeMessage = Carbon::parse($data->startTime)->format('H:i');
                $endTimeMessage = Carbon::parse($data->endTime)->format('H:i');
                $message = 'Jadwal Dengan Jam ' . $startTimeMessage . ' sampai ' . $endTimeMessage . ' Sudah Ada';
                if(request()->wantsJson()){
                    return $this->handleResponseError->ResponseException($message, 400);
                }else{
                    return [
                        'error' => true,
                        'message' => $message
                    ];
                }
            }
            $create = $this->jadwalModal->create([
                'start_time' => $data->startTime,
                'end_time' => $data->endTime,
                'jadwal' => $data->keterangan
            ]);
            if ($create) {
                if (request()->wantsJson()) {
                    return(JadwalResource::make($create->fresh()))->response()->setStatusCode(201);
                } else {
                    return true;
                }
            }else{
                return $this->handleResponseError->ResponseException('Tidak berhasil menambah jadwal', 400);
            }
        } catch (Exception $e) {
            if (request()->wantsJson()) {
                return $this->handleResponseError->responseError($e);
            } else {
                return false;
            }
        }
    }

}