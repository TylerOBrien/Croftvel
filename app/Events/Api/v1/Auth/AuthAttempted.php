<?php

namespace App\Events\Api\v1\Auth;

use App\Models\Identity;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AuthAttempted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The identity of the user that successfully authenticated.
     *
     * @var \App\Models\Identity
     */
    public $identity;

    /**
     * Whether the auth attempt was successful.
     *
     * @var bool
     */
    public $is_success;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Identity $identity, bool $is_success)
    {
        $this->identity = $identity;
        $this->is_success = $is_success;
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
