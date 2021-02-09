<?php

namespace App\Events\Api\v1\Auth;

use App\Models\User;

use Illuminate\Queue\SerializesModels;

class LoginFailedEvent
{
    use SerializesModels;
    
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
