<?php

namespace App\Mail\Api\v1\Recovery;

use App\Models\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyRecovery extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The recipient of the mail.
     * 
     * @var \App\Models\User
     */
    protected $recipient;

    /**
     * The plaintext recovery code.
     * 
     * @var string
     */
    protected $code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $recipient, string $code)
    {
        $this->recipient = $recipient;
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('mail.recovery.verify-recovery.subject'))
                    ->markdown('mail.recovery.verify-recovery', [
                        'recipient' => $this->recipient,
                        'code' => $this->code ]);
    }
}
