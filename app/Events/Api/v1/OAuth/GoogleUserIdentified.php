<?php

namespace App\Events\Api\v1\OAuth;

use Illuminate\Broadcasting\{ InteractsWithSockets, PrivateChannel };
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use Laravel\Socialite\Two\GoogleProvider;

class GoogleUserIdentified
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var \Laravel\Socialite\Two\GoogleProvider
     */
    public $driver;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(GoogleProvider $driver)
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
