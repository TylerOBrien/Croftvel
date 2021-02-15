<?php

namespace App\Events\Api\v1\User;

use App\Models\{ Account, User };

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserAddedToAccount
{
    use Dispatchable, SerializesModels;

    /**
     * The user that was added to the account.
     * 
     * @var \App\Models\User
     */
    public $user;

    /**
     * The account to which the user was added.
     * 
     * @var \App\Models\Account
     */
    public $account;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Account $account)
    {
        $this->user = $user;
        $this->account = $account;
    }
}
