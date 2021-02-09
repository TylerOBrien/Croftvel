<?php

namespace App\Traits\Models;

use App\Models\Meta;

trait HasMeta
{
    /**
     * @return HasMany
     */
    public function meta()
    {
        return $this->morphMany(Meta::class, 'owner');
    }
}
