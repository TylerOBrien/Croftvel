<?php

namespace App\Observers\Api\v1;

use App\Models\ProfileField;
use App\Schemas\Profile\ProfileFieldSchema;

class ProfileFieldObserver
{
    /**
     * Handle the profile field "updating" event.
     *
     * @param  \App\Models\ProfileField  $profile_field
     *
     * @return void
     */
    public function updating(ProfileField $profile_field): void
    {
        (new ProfileFieldSchema)->validate($profile_field->getDirty());
    }
}
