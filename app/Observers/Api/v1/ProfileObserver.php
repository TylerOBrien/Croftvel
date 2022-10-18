<?php

namespace App\Observers\Api\v1;

use App\Models\Profile;
use App\Schemas\Profile\ProfileSchema;

class ProfileObserver
{
    /**
     * Handle the profile "updating" event.
     *
     * @param  \App\Models\Profile  $profile
     *
     * @return void
     */
    public function updating(Profile $profile): void
    {
        (new ProfileSchema)->validate($profile->getDirty());
    }
}
