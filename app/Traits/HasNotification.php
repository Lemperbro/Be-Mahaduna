<?php
namespace App\Traits;

use App\Models\FcmToken;
use App\Models\Wali;
use App\Notifications\NewUploadsNotification;
use Illuminate\Notifications\Notifiable;


trait HasNotification
{
    use Notifiable;


    function fcm_token()
    {
        // $forWali && $wali_id !== null ? $token = Wali::where('wali_id', $wali_id)->first()->pluck('fcm_token')->toArray() :
        //     $token = FcmToken::get()->pluck('token')->toArray();
        // return $token;

        $token = FcmToken::get()->pluck('token')->toArray();
        return $token;
    }

    function pushNotifikasi($titleNotif, $messageNotif)
    {
        $this->notify(new NewUploadsNotification(title: $titleNotif, message: $messageNotif));
    }
}