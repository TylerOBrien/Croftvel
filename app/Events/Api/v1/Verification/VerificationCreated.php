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
     * The plaintext verification code.
     * 
     * @var string
     */
    public $plaintext_code;

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
        $this->plaintext_code = $verification->consumePlaintextCode();
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
