<?php

namespace App\Traits\Models;

use App\Models\Video;

trait HasVideos
{
    /**
     * @return HasMany
     */
    public function videos()
    {
        return $this->morphMany(Video::class, 'owner');
    }
}
