<?php

namespace App\Http\Controllers\Api\Notification;

use App\Http\Controllers\Controller;
use App\Repositories\Notifikasi\NotifikasiInterface;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    private $notificationInterface;

    public function __construct(NotifikasiInterface $notificationInterface)
    {
        $this->notificationInterface = $notificationInterface;
    }

    public function allNotifikasi(Request $request)
    {
        $for = $request->for ?? 'all';
        $paginate = $request->paginate ?? 15;

        return $this->notificationInterface->allNotifikasi(for: $for, paginate: $paginate);
    }

    public function allNotifikasiWali(Request $request)
    {
        $wali_id = auth()->user()->wali_id;
        $for = $request->for ?? 'all';
        $paginate = $request->paginate ?? 15;
        return $this->notificationInterface->allNotifikasi(for: $for, paginate: $paginate, wali_id: $wali_id);
    }

}
