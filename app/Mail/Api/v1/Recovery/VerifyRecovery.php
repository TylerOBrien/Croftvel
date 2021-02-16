<?php

namespace App\Mail\Api\v1\Recovery;

use App\Models\{ Recovery, User };

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
     * The recovery instance.
     * 
     * @var \App\Models\Recovery
     */
    protected $recovery;

    /**
     * The plaintext recovery code.
     * 
     * @var string
     */
    protected $plaintext_code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $recipient, Recovery $recovery, string $plaintext_code)
    {
        $this->recipient = $recipient;
        $this->recovery = $recovery;
        $this->plaintext_code = $plaintext_code;
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
                        'recovery' => $this->recovery,
                        'plaintext_code' => $this->plaintext_code ]);
    }
}
