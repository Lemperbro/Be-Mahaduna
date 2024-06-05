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
    private $title, $message, $for;

    /**
     * Create a new notification instance.
     */
    public function __construct($title, $message, $for = 'all')
    {
        $this->title = $title;
        $this->message = $message;
        $this->for = $for;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [FcmChannel::class];
    }

    public function toFcm($notifiable): FcmMessage
    {
        Log::info('test', ['data' => 'berhasil']);
        return (
            new FcmMessage(
                notification: new FcmNotification(
                    title: $this->title,
                    body: $this->message,
                )
            )
        );

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
            'created_at' => now(),
        ];
    }
}
