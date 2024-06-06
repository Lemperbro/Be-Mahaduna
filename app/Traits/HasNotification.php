<?php
namespace App\Traits;

use App\Models\FcmToken;
use App\Notifications\NewUploadsNotification;
use Illuminate\Notifications\Notifiable;


trait HasNotification
{
    use Notifiable;


    function fcm_token()
    {
        $token = FcmToken::get()->pluck('token')->toArray();
        return $token;
    }

    function pushNotifikasi($titleNotif, $messageNotif)
    {
        $this->notify(new NewUploadsNotification(title: $titleNotif, message: $messageNotif));
    }
}