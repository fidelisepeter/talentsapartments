<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

use function App\View\Components\send_mail;

class ResetPassword extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;

    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
       $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Reset Password Notification')
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', $url)
            ->line('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')])
            ->line('If you did not request a password reset, no further action is required.');
    //  return (new MailMessage)
    //         ->subject('Reset Password Notification')
    //         ->line('You are receiving this email because we received a password reset request for your account.')
    //         ->action('Reset Password', url('password/reset', $this->token))
    //         ->line('If you did not request a password reset, no further action is required.');
    }
}