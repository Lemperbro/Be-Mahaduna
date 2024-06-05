<?php

namespace App\Observers;

use App\Models\PlaylistVideo;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use App\Notifications\NewUploadsNotification;

class YoutubeObserver
{


    private $titleNotif = 'Kajian',
    $messageNotif = 'Playlist Kajian Baru Tersedia';
    /**
     * Handle the PlaylistVideo "created" event.
     */
    public function created(PlaylistVideo $playlistVideo): void
    {

        // $playlistVideo->notify(new NewUploadsNotification(title: $this->titleNotif, message: $this->messageNotif));
        $this->sendNotification('youtube', 'coba', 'halo semua');
    }
    public function sendNotification($topic, $title, $body)
    {
        $firebase = app('firebase.messaging');
        $message = CloudMessage::withTarget('topic', $topic)
            ->withNotification(Notification::create($title, $body));

        $firebase->send($message);
        Log::info('firebase', ['data' => $firebase]);
    }

    /**
     * Handle the PlaylistVideo "updated" event.
     */
    public function updated(PlaylistVideo $playlistVideo): void
    {
        //
    }

    /**
     * Handle the PlaylistVideo "deleted" event.
     */
    public function deleted(PlaylistVideo $playlistVideo): void
    {
        //
    }

    /**
     * Handle the PlaylistVideo "restored" event.
     */
    public function restored(PlaylistVideo $playlistVideo): void
    {
        //
    }

    /**
     * Handle the PlaylistVideo "force deleted" event.
     */
    public function forceDeleted(PlaylistVideo $playlistVideo): void
    {
        //
    }
}
