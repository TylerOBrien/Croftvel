<?php

namespace App\Traits\Models;

use App\Models\Profile;

trait HasProfiles
{
    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function profiles()
    {
        return $this->morphMany(Profile::class, 'owner');
    }
}
