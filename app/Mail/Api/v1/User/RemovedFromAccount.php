<?php

namespace App\Mail\Api\v1\User;

use App\Models\{ Account, User };

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RemovedFromAccount extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The recipient of the mail.
     *
     * @var \App\Models\User
     */
    protected $recipient;

    /**
     * The user that was removed from the account.
     *
     * @var \App\Models\User
     */
    protected $user;

    /**
     * The account from which the user was removed.
     *
     * @var \App\Models\Account
     */
    protected $account;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\User  $recipient  The user who will receive the email.
     * @param  \App\Models\User  $user  The user that was removed from the account.
     * @param  \App\Models\Account  $account  The account from which the user was removed.
     *
     * @return void
     */
    public function __construct(User $recipient, User $user, Account $account)
    {
        $this->recipient = $recipient;
        $this->user = $user;
        $this->account = $account;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('mail.user.removed-from-account.subject'))
                    ->markdown('mail.user.removed-from-account', [
                        'recipient' => $this->recipient,
                        'user' => $this->user,
                        'account' => $this->account,
                    ]);
    }
}
