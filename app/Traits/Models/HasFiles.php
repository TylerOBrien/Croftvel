<?php

namespace App\Traits\Models;

use App\Models\File;

trait HasFiles
{
    /**
     * @return MorphMany
     */
    public function files()
    {
        return $this->morphMany(File::class, 'owner');
    }
}
