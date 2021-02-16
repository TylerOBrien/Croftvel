<?php

namespace App\Notifications\Api\v1\Recovery;

use App\Mail\Api\v1\Recovery\VerifyRecovery;
use App\Models\{ Recovery, User };

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class VerifyRecoveryNotification extends Notification
{
    use Queueable;

    /**
     * The newly created recovery instance.
     * 
     * @var \App\Models\Recovery
     */
    protected $recovery;

    /**
     * The plaintext recovery code.
     * 
     * @var string
     */
    protected $code;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Recovery $recovery, string $code)
    {
        $this->recovery = $recovery;
        $this->code = $code;
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
        $mail = new VerifyRecovery($notifiable, $this->recovery, $this->code);
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
