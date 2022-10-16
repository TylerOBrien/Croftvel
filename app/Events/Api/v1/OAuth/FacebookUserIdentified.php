<?php

namespace App\Events\Api\v1\OAuth;

use Illuminate\Broadcasting\{ InteractsWithSockets, PrivateChannel };
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use Laravel\Socialite\Two\FacebookProvider;

class FacebookUserIdentified
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var \Laravel\Socialite\Two\FacebookProvider
     */
    public $driver;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(FacebookProvider $driver)
    {
        $this->driver = $driver;
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
