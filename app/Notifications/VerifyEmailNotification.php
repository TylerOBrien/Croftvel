<?php

namespace App\Notifications;

use App\Mail\VerifyEmail;
use App\Models\User;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class VerifyEmailNotification extends Notification
{
    use Queueable;

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
     * @return \App\Mail\VerifyEmail
     */
    public function toMail(User $notifiable)
    {
        $mail = new VerifyEmail($notifiable);
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
}
