<?php
namespace App\Repositories\Jadwal;

use Exception;
use Carbon\Carbon;
use App\Models\Jadwal;
use App\Repositories\Jadwal\JadwalInterface;
use App\Http\Resources\Jadwal\JadwalResource;
use App\Repositories\HandleError\ResponseErrorRepository;

class JadwalRepository implements JadwalInterface
{

    private $jadwalModel;
    private $handleResponseError;
    public function __construct()
    {
        $this->jadwalModel = new Jadwal;
        $this->handleResponseError = new ResponseErrorRepository;
    }
    /**
     * untuk mengambil semua data jadwal
     * @return [type]
     */
    public function getAll()
    {
        $data = $this->jadwalModel->orderBy('start_time', 'asc')->get();
        if (request()->wantsJson()) {
            return(JadwalResource::collection($data))->response()->setStatusCode(200);
        } else {
            return $data;
        }
    }
    public function jadwalTerisiErrorMessage($startTime, $endTime)
    {
        $startTimeMessage = Carbon::parse($startTime)->format('H:i');
        $endTimeMessage = Carbon::parse($endTime)->format('H:i');
        return 'Jadwal dengan waktu ' . $startTimeMessage . ' - ' . $endTimeMessage . ' sudah terisi. Pilih waktu lain.';
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
            $cekData = $this->jadwalModel->where('start_time', '<=', $data->endTime)->where('end_time', '>=', $data->startTime)->count();
            // dd($cekData);
            if ($cekData > 0) {
                $message = $this->jadwalTerisiErrorMessage($data->startTime, $data->endTime);
                if (request()->wantsJson()) {
                    return $this->handleResponseError->ResponseException($message, 400);
                } else {
                    return [
                        'error' => true,
                        'message' => $message
                    ];
                }
            }
            $create = $this->jadwalModel->create([
                'start_time' => $data->startTime,
                'end_time' => $data->endTime,
                'jadwal' => $data->keterangan,
                'user_created' => auth()->user()->user_id,
                'updated_at' => null
            ]);
            if ($create) {
                if (request()->wantsJson()) {
                    return(JadwalResource::make($create->fresh()))->response()->setStatusCode(201);
                } else {
                    return true;
                }
            } else {
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
    /**
     * untuk update data jadwal
     * @param mixed $data data baru untuk update
     * @param mixed $oldData data yang akan di update
     * 
     * @return [type]
     */
    public function update($data, $oldData)
    {
        try {
            $cekData = $this->jadwalModel->where('start_time', '<=', $data->endTime)->where('end_time', '>=', $data->startTime)->whereNotIn('jadwal_id', [$oldData->jadwal_id])->count();
            if ($cekData > 0) {
                $message = $this->jadwalTerisiErrorMessage($data->startTime, $data->endTime);
                if (request()->wantsJson()) {
                    return $this->handleResponseError->ResponseException($message, 400);
                } else {
                    return [
                        'error' => true,
                        'message' => $message
                    ];
                }
            }
            $update = $oldData->update([
                'start_time' => $data->startTime,
                'end_time' => $data->endTime,
                'jadwal' => $data->keterangan,
                'user_updated' => auth()->user()->user_id,
            ]);
            if ($update) {
                if (request()->wantsJson()) {
                    return(JadwalResource::make($oldData->fresh()))->response()->setStatusCode(201);
                } else {
                    return true;
                }
            } else {
                return $this->handleResponseError->ResponseException('Tidak berhasil memperbarui jadwal', 400);
            }

        } catch (Exception $e) {
            if (request()->wantsJson()) {
                return $this->handleResponseError->responseError($e);
            } else {
                return false;
            }
        }
    }
    /**
     * untuk menhapus data jadwal
     * @param mixed $data data yang akan di hapus
     * 
     * @return [type]
     */
    public function delete($data)
    {
        try {
            $delete = $data->update([
                'deleted_at' => now(),
                'user_deleted' => auth()->user()->user_id,
                'deleted' => true
            ]);
            if ($delete) {
                $data->updated_at = null;
                $data->save();

                if (request()->wantsJson()) {
                    response()->json([
                        'success' => true,
                        'code' => 204,
                        'message' => 'Berhasil menghapus jadwal'
                    ]);
                } else {
                    return true;
                }
            } else {
                return $this->handleResponseError->ResponseException('Tidak berhasil menghapus jadwal', 400);
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