<?php

namespace App\Traits\Models;

use App\Models\File;

trait HasFiles
{
    /**
     * @return HasMany
     */
    public function files()
    {
        return $this->morphMany(File::class, 'owner');
    }
}
