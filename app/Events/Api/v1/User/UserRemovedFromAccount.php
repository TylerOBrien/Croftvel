<?php

namespace App\Events\Api\v1\User;

use App\Models\{ Account, User };

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserRemovedFromAccount
{
    use Dispatchable, SerializesModels;

    /**
     * The user that was added to the account.
     * 
     * @var \App\Models\User
     */
    public $user;

    /**
     * The account from which the user was removed.
     * 
     * @var \App\Models\Account
     */
    public $account;

    /**
     * Create a new event instance.
     * 
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account  $account
     *
     * @return void
     */
    public function __construct(User $user, Account $account)
    {
        $this->user = $user;
        $this->account = $account;
    }
}
