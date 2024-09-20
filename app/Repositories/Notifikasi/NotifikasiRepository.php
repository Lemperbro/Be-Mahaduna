<?php
namespace App\Repositories\Notifikasi;

use App\Http\Resources\Notification\NotificationResource;
use App\Models\Notification;

class NotifikasiRepository implements NotifikasiInterface
{
    private $notifikasiModel;

    public function __construct()
    {
        $this->notifikasiModel = new Notification;
    }


    /**
     * untuk menampilkan semua notifikasi
     * @param string $for
     * @param string $paginate
     * @param int|null $wali_id
     * 
     * @return [type]
     */
    public function allNotifikasi($for = 'all', $paginate = '15', $wali_id = null)
    {
        $data = $this->notifikasiModel->where('data->for', $for);
        if ($wali_id !== null) {
            $data->where('data->wali_id', $wali_id);
        }
        $data = $data->paginate($paginate);
        if (request()->wantsJson()) {
            return (NotificationResource::collection($data))->response()->setStatusCode(200);
        } else {
            return $data;
        }
    }
}