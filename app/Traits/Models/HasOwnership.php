<?php

namespace App\Traits\Models;

use Illuminate\Support\Str;

trait HasOwnership
{
    /**
     * @return MorphTo
     */
    public function owner()
    {
        return $this->morphTo();
    }

    /**
     * @return void
     */
    public function setOwnerTypeAttribute(string $owner_type)
    {
        $this->attributes['owner_type'] = Str::start($owner_type, config('croft.models.namespace'));
    }
}
