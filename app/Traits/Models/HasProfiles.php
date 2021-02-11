<?php

namespace App\Traits\Models;

use App\Models\Profile;

trait HasProfiles
{
    /**
     * @return MorphMany
     */
    public function profiles()
    {
        return $this->morphMany(Profile::class, 'owner');
    }
}
