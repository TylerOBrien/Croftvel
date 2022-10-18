<?php

namespace App\Listeners\Api\v1\Verification;

use App\Enums\Verification\VerificationAbility;
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
        match ($event->verification->verifiable_type) {
            Identity::class => $this->handleIdentity($event),
        };
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
        (match ($event->verification->ability) {
            VerificationAbility::Store => IdentityVerificationCreated::class,
            VerificationAbility::Recover => RecoveryVerificationCreated::class,
        })::dispatch($event->verification->verifiable, $event->plaintext_code);
    }
}
