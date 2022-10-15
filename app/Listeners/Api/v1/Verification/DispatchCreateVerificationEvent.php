<?php

namespace App\Listeners\Api\v1\Verification;

use App\Events\Api\v1\Identity\IdentityVerificationCreated;
use App\Events\Api\v1\Recovery\RecoveryVerificationCreated;
use App\Events\Api\v1\Verification\VerificationCreated;
use App\Models\Identity;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DispatchCreateVerificationEvent implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  \App\Events\Api\v1\Verification\VerificationCreated  $event
     *
     * @return void
     */
    public function handle(VerificationCreated $event)
    {
        switch ($event->verification->verifiable_type) {
        case Identity::class:
            $this->handleIdentity($event);
            break;
        }
    }

    /**
     * Handle the event for the Identity model.
     *
     * @param  \App\Events\Api\v1\Verification\VerificationCreated  $event
     *
     * @return void
     */
    protected function handleIdentity(VerificationCreated $event)
    {
        switch ($event->verification->ability) {
        case 'store':
            IdentityVerificationCreated::dispatch($event->verification->verifiable, $event->plaintext_code);
            break;
        case 'recover':
            RecoveryVerificationCreated::dispatch($event->verification->verifiable, $event->plaintext_code);
            break;
        }
    }
}
