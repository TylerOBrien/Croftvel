<?php

namespace App\Traits\Models;

trait HasOwnership
{
    /**
     * 
     */
    public function getOwnerAttribute()
    {
        return call_user_func("{$this->owner_type}::find", $this->owner_id);
    }

    /**
     * 
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
