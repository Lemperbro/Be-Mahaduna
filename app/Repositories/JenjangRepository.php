<?php
namespace App\Repositories;

use App\Http\Resources\Jenjang\JenjangResource;
use App\Models\Jenjang;
use App\Repositories\Interfaces\JenjangInterface;

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
            return(JenjangResource::collection($data))->response()->setStatusCode(200);
        } else {
            return $data;
        }
    }
}