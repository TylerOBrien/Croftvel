<?php

namespace App\Traits\Models;

use App\Models\Image;

trait HasLogo
{
    use HasImages;

    /**
     * @return \App\Models\Image|null
     */
    public function getLogoAttribute() : Image|null
    {
        return $this->images()->whereName('logo.primary.xl')->first();
    }
}
