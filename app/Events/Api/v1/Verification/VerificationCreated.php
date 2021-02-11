<?php

namespace App\Events\Api\v1\Verification;

use App\Models\Verification;

use Illuminate\Broadcasting\{ InteractsWithSockets, PrivateChannel };
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VerificationCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The newly created verification instance.
     * 
     * @var \App\Models\Verification
     */
    public $verification;

    /**
     * Create a new event instance.
     * 
     * @param  \App\Models\Verification $verification
     *
     * @return void
     */
    public function __construct(Verification $verification)
    {
        $this->verification = $verification;
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
