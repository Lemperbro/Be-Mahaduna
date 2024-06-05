<?php

namespace App\Models;

use App\Notifications\NewUploadsNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class PlaylistVideo extends Model
{
    use HasFactory, SoftDeletes, Notifiable;
    protected $table = 'playlist_video';
    protected $primaryKey = 'playlist_video_id';


    protected $guarded = [
        'playlist_video_id'
    ];

    /**
     * Specifies the user's FCM token
     *
     * @return string|array
     */
    public function routeNotificationForFcm()
    {
        return $this->fcm_token;
    }

}
