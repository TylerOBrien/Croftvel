<?php

namespace App\Events\Api\v1\Identity;

use App\Models\Identity;

use Illuminate\Broadcasting\{ InteractsWithSockets, PrivateChannel };
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class IdentityCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var \App\Models\Identity
     */
    public $identity;

    /**
     * Create a new event instance.
     * 
     * @param  \App\Models\Identity $identity
     *
     * @return void
     */
    public function __construct(Identity $identity)
    {
        $this->identity = $identity;
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
