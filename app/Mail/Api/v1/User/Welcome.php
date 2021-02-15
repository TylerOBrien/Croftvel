<?php

namespace App\Mail\Api\v1\User;

use App\Models\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Welcome extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The recipient of the mail.
     * 
     * @var \App\Models\User
     */
    protected $recipient;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $recipient)
    {
        $this->recipient = $recipient;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('mail.user.welcome.subject'))
                    ->markdown('mail.user.welcome', [
                        'recipient' => $this->recipient ]);
    }
}
