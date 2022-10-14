<?php

namespace App\Events\Api\v1\Account;

use App\Models\User;

use Illuminate\Broadcasting\{ InteractsWithSockets, PrivateChannel };
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AbilitiesGivenToUser
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The User model instance that was given abilities.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * The Ability model instances that were given to the user.
     *
     * @var \Illuminate\Support\Database\Collection
     */
    public $abilities;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\User  $user  The user that was given abilities.
     * @param \Illuminate\Database\Eloquent\Collection  $abilities  The Ability model instances that were given to the user.
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
