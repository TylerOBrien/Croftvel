<?php

namespace App\Traits\Models;

trait HasLogo
{
    use HasImages;

    /**
     * @return \App\Models\Image
     */
    public function getLogoAttribute()
    {
        return $this->images()->whereName('logo.primary.xl')->first();
    }
}
