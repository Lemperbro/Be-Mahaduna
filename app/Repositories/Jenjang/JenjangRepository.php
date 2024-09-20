<?php
namespace App\Repositories\Jenjang;

use App\Models\Jenjang;
use App\Repositories\Jenjang\JenjangInterface;
use App\Http\Resources\Jenjang\JenjangResource;

class JenjangRepository implements JenjangInterface
{
    private $jenjangModel;
    public function __construct()
    {
        $this->jenjangModel = new Jenjang;
    }

    /**
     * untuk mengambil semua data jenjang
     * @return [type]
     */
    public function getAll()
    {
        $data = $this->jenjangModel->get();
        if (request()->wantsJson()) {
            return (JenjangResource::collection($data))->response()->setStatusCode(200);
        } else {
            return $data;
        }
    }

    /**
     * untuk menambah data kelas 
     * @param mixed $data
     * 
     * @return [type]
     */
    public function tambahKelas($data)
    {
        $up = $this->jenjangModel->create([
            'jenjang' => $data->kelas,
            'user_created' => auth()->user()->user_id,
        ]);
        if (!$up) {
            return false;
        }
        return true;
    }
    /**
     * untuk mengubah data kelas
     * @param mixed $data
     * @param mixed $oldData
     * 
     * @return [type]
     */
    public function updateDataKelas($data, $oldData)
    {
        $edit = $oldData->update([
            'jenjang' => $data->kelas,
            'user_updated' => auth()->user()->user_id,
        ]);
        if (!$edit) {
            return false;
        }
        return true;
    }
}