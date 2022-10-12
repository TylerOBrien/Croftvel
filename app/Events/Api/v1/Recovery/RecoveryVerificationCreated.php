<?php

namespace App\Events\Api\v1\Recovery;

use App\Models\Identity;

use Illuminate\Broadcasting\{ InteractsWithSockets, PrivateChannel };
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RecoveryVerificationCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var \App\Models\Identity
     */
    public $identity;

    /**
     * @var string
     */
    public $plaintext_code;

    /**
     * Create a new event instance.
     *
     * @param  \App\Models\Verification  $identity
     * @param  string  $plaintext_code
     *
     * @return void
     */
    public function __construct(Identity $identity, string $plaintext_code)
    {
        $this->identity = $identity;
        $this->plaintext_code = $plaintext_code;
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
