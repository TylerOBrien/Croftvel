<?php

namespace App\Mail\Api\v1\Account;

use App\Models\{ Account, User };

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserAdded extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The recipient of the mail.
     * 
     * @var \App\Models\User
     */
    protected $recipient;

    /**
     * The account to which the new user was added.
     * 
     * @var \App\Models\Account
     */
    protected $account;

    /**
     * The user that was added to the account.
     * 
     * @var \App\Models\User
     */
    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $recipient, Account $account, User $user)
    {
        $this->recipient = $recipient;
        $this->account = $account;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('mail.account.user-added.subject'))
                    ->markdown('mail.account.user-added', [
                        'recipient' => $this->recipient,
                        'account' => $this->account,
                        'user' => $this->user ]);
    }
}
