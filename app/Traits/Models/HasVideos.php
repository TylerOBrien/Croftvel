<?php

namespace App\Traits\Models;

use App\Models\Video;

trait HasVideos
{
    /**
     * @return MorphMany
     */
    public function videos()
    {
        return $this->morphMany(Video::class, 'owner');
    }
}
