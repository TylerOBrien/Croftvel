<?php

namespace App\Notifications;

use App\Mail\PasswordResetRequest;
use App\Models\User;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PasswordResetRequestNotification extends Notification
{
    use Queueable;

    public $token;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  \App\Models\User  $notifiable
     * @return array
     */
    public function via(User $notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  \App\Models\User  $notifiable
     * @return \App\Mail\PasswordResetRequest
     */
    public function toMail(User $notifiable)
    {
        $mail = new PasswordResetRequest($this->getResetUrl($notifiable));
        $mail->to($notifiable->email, $notifiable->full_name);
        $mail->from(config('mail.from.address'), config('mail.from.name'));

        return $mail;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  \App\Models\User  $notifiable
     * @return array
     */
    public function toArray(User $notifiable)
    {
        return [
            //
        ];
    }

    /**
     * @param  \App\Models\User  $notifiable
     * @return string
     */
    protected function getResetUrl(User $notifiable)
    {
        $url = config('app.url_user');

        // maybe renable this?
        /* if ($notifiable->type === 'User') {
            $url = config('app.url_user');
        } else if (in_array($notifiable->type, [ 'Admin' ])) {
            $url = config('app.url_admin');
        } */

        return "$url/reset-password?token={$this->token}&email=" . urlencode($notifiable->getEmailForPasswordReset());
    }
}
