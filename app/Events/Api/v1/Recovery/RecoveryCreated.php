<?php

namespace App\Events\Api\v1\Recovery;

use App\Models\Recovery;

use Illuminate\Broadcasting\{ InteractsWithSockets, PrivateChannel };
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RecoveryCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The newly created recovery instance.
     * 
     * @var \App\Models\Recovery
     */
    public $recovery;

    /**
     * The plaintext recovery code.
     * 
     * @var string
     */
    public $plaintext_code;

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
