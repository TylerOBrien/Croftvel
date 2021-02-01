<?php

namespace App\Traits\Models;

use App\Models\Image;

trait HasImages
{
    /**
     * 
     */
    public function images()
    {
        return $this->hasMany(Image::class, 'owner_id')
                    ->where('owner_type', self::class);
    }
}
