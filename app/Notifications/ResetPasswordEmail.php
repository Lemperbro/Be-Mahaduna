<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordEmail extends Notification
{
    use Queueable;
    private $token, $email;


    /**
     * Create a new notification instance.
     */
    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $resetUrl = route('auth.resetPassword', ['token' => $this->token, 'email' => $this->email]);
        $emailPondok = config('services.pondok.email');

        return (new MailMessage)
            ->view('notification.resetPasswordEmail', ['resetUrl' => $resetUrl])
            ->from($emailPondok, "Ma'haduNa")
            ->subject("Reset Password Ma'haduNa");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
