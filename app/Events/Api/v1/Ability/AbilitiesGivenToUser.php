<?php

namespace App\Events\Api\v1\Account;

use App\Models\User;

use Illuminate\Broadcasting\{ InteractsWithSockets, PrivateChannel };
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AbilitiesGivenToUser
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The user model instance that was given abilities.
     *
     * @var \App\Models\User
     */
    public $user;

    /**
     * The resource the abilities were applied to.
     *
     * Is either the string version of the model's fully qualified class name,
     * which would mean the abilities apply to all instances of the model, or
     * is a singular instance of the model, which would mean the ability will
     * only apply to that instance.
     *
     * @var string|\Illuminate\Database\Eloquent\Model
     */
    public $resource;

    /**
     * The names of the abilities given to the user.
     *
     * @var array<string>
     */
    public $abilities;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\User  $user  The user that was given abilities.
     * @param  string|\Illuminate\Database\Eloquent\Model  $resource  The resource the abilities applied to.
     * @param  array<string>  $abilities  The names of the abilities given to the user.
     *
     * @return void
     */
    public function __construct(User $user, $resource, array $abilities)
    {
        $this->user = $user;
        $this->resource = $resource;
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
