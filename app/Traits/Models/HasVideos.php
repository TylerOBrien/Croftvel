<?php

namespace App\Traits\Models;

use App\Models\Video;

trait HasVideos
{
    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * @return MorphMany
     */
    public function videos()
    {
        return $this->morphMany(Video::class, 'owner');
    }
}
