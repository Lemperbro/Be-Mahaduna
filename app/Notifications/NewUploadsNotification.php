<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\Notification as FcmNotification;
use Illuminate\Notifications\Notification;

class NewUploadsNotification extends Notification
{
    use Queueable;
    private $title, $message, $for, $wali_id;

    /**
     * Create a new notification instance.
     */
    public function __construct($title, $message, $for = 'all', $wali_id = null)
    {
        $this->title = $title;
        $this->message = $message;
        $this->for = $for;
        $this->wali_id = $wali_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {

        return [FcmChannel::class, 'database'];
    }

    public function toFcm($notifiable): FcmMessage
    {
        $send = (
            new FcmMessage(
                notification: new FcmNotification(
                    title: $this->title,
                    body: $this->message,
                ),

            )
        );

        return $send;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => $this->title,
            'body' => $this->message,
            'for' => $this->for,
            'wali_id' => $this->wali_id,
            'created_at' => now(),
        ];
    }
}
