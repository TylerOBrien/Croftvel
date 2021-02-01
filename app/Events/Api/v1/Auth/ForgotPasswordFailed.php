<?php

namespace App\Events\Api\v1\Auth;

use App\Models\User;

use Illuminate\Queue\SerializesModels;

class ForgotPasswordFailed
{
    use SerializesModels;

    public $user;
    public $result;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(?User $user, string $result)
    {
        $this->user = $user;
        $this->result = $result;
    }
}
