<?php

namespace Quicktrack\User\Infrastructure\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class QueuedResetPassword extends Notification implements ShouldQueue
{
    use Queueable;

    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = "{$_ENV['VIEW_APP_URL']}/auth/reset-password/{$this->token}?email={$notifiable->email}";

        return (new MailMessage)
            ->error()
            ->subject('Notification Subject')
            ->view('auth.reset-password-email', ['url' => $url]);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
