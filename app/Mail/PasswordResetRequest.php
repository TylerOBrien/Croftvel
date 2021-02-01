<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $ttl = config('auth.passwords.' . config('auth.defaults.passwords') . '.expire');
        $ttl_type = 'minutes';

        return $this->subject(trans('mail.user.password-reset-request.subject'))
                    ->markdown('mail.user.password-reset-request', array_merge(
                        [ 'url' => $this->url ], compact('ttl', 'ttl_type')
                    ));
    }
}
