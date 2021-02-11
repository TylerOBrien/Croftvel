<?php

namespace App\Notifications\Api\v1\Identity;

use App\Mail\Api\v1\Identity\VerifyIdentity;
use App\Models\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class VerifyIdentityNotification extends Notification
{
    use Queueable;

    /**
     * The plaintext recovery code.
     * 
     * @var string
     */
    protected $plaintext_code;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $plaintext_code)
    {
        $this->plaintext_code = $plaintext_code;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  \App\Models\User  $notifiable
     * 
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
     * 
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(User $notifiable)
    {
        $mail = new VerifyIdentity($notifiable, $this->plaintext_code);
        $mail->to($notifiable->email, $notifiable->full_name);
        $mail->from(config('mail.from.address'), config('mail.from.name'));

        return $mail;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  \App\Models\User  $notifiable
     * 
     * @return array
     */
    public function toArray(User $notifiable)
    {
        return [
            //
        ];
    }
}
