<?php

namespace App\Events\Api\v1\Account;

use App\Models\User;

use Illuminate\Broadcasting\{ InteractsWithSockets, PrivateChannel };
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AbilitiesTakenFromUser
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The User model instance that had abilities removed.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * The Ability model instances that were taken from the user.
     *
     * @var \Illuminate\Support\Database\Collection
     */
    public $abilities;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\User  $user  The User model instance that had abilities removed.
     * @param \Illuminate\Database\Eloquent\Collection  $abilities  The Ability model instances that were taken from the user.
     *
     * @return void
     */
    public function __construct(User $user, Collection $abilities)
    {
        $this->user = $user;
        $this->abilities = $abilities;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
