<?php

namespace App\Traits\Models;

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
        if (strpos($owner_type, 'App\\Models\\') === 0) {
            $this->attributes['owner_type'] = $owner_type;
        } else {
            $this->attributes['owner_type'] = "App\\Models\\$owner_type";
        }
    }
}
