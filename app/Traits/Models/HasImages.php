<?php

namespace App\Traits\Models;

use App\Models\Image;

trait HasImages
{
    /**
     * @return MorphMany
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'owner');
    }
}
