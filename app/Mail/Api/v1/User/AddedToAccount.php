<?php

namespace App\Mail\Api\v1\User;

use App\Models\{ Account, User };

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AddedToAccount extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The recipient of the mail.
     *
     * @var \App\Models\User
     */
    protected $recipient;

    /**
     * The user that was added to the account.
     *
     * @var \App\Models\User
     */
    protected $user;

    /**
     * The account to which the new user was added.
     *
     * @var \App\Models\Account
     */
    protected $account;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\User  $recipient  The user who will receive the email.
     * @param  \App\Models\User  $user  The user that was added to the account.
     * @param  \App\Models\Account  $account  The account to which the new user was added.
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
        return $this->subject(trans('mail.user.added-to-account.subject'))
                    ->markdown('mail.user.added-to-account', [
                        'recipient' => $this->recipient,
                        'user' => $this->user,
                        'account' => $this->account,
                    ]);
    }
}
