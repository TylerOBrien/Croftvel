<?php

namespace App\Mail\Api\v1\Identity;

use App\Models\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyIdentity extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \App\Models\User
     */
    protected $user;

    /**
     * The plaintext verification code.
     * 
     * @var string
     */
    protected $plaintext_code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, string $plaintext_code)
    {
        $this->user = $user;
        $this->plaintext_code = $plaintext_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('mail.identity.verify-identity.subject'))
                    ->markdown('mail.identity.verify-identity', [
                        'user' => $this->user,
                        'plaintext_code' => $this->plaintext_code ]);
    }
}
