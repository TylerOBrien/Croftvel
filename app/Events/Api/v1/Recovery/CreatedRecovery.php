<?php

namespace App\Events\Api\v1\Recovery;

use App\Models\Recovery;

use Illuminate\Broadcasting\{ InteractsWithSockets, PrivateChannel };
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreatedRecovery
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var \App\Models\Recovery
     */
    public $recovery;

    /**
     * Create a new event instance.
     * 
     * @param  \App\Models\Recovery $recovery
     *
     * @return void
     */
    public function __construct(Recovery $recovery)
    {
        $this->recovery = $recovery;
        $this->plaintext_code = $recovery->consumePlaintextCode();
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
