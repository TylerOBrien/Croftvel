<?php

namespace App\Mail\Api\v1\Recovery;

use App\Models\{ Identity, User };

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
     * The identity that is being recovered.
     *
     * @var \App\Models\Identity
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
     * @param  \App\Models\User  $recipient  The user who will receive the email.
     * @param  \App\Models\Identity  $identity  The identity that the user is attempting to recover.
     * @param  string  $plaintext_code  The plaintext version of the code the user will use to verify.
     *
     * @return void
     */
    public function __construct(User $recipient, Identity $identity, string $plaintext_code)
    {
        $this->recipient = $recipient;
        $this->identity = $identity;
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
                        'identity' => $this->identity,
                        'plaintext_code' => $this->plaintext_code,
                    ]);
    }
}
