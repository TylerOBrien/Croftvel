<?php

namespace App\Events\Api\v1\Recovery;

use App\Models\Recovery;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RecoveryVerified
{
    use Dispatchable, SerializesModels;

    /**
     * The instance of the recovery that was just verified.
     * 
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
    }
}
