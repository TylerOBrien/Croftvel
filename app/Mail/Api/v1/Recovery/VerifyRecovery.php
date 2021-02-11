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
     * @var \App\Models\User
     */
    protected $user;

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
    public function __construct(User $user, string $code)
    {
        $this->user = $user;
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('mail.guest.recovery.verify-recovery.subject'))
                    ->markdown('mail.guest.recovery.verify-recovery', [
                        'user' => $this->user,
                        'code' => $this->code ]);
    }
}
