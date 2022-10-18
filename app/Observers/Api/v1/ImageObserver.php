<?php

namespace App\Observers\Api\v1;

use App\Enums\Image\ImageOrientation;
use App\Models\Image;
use App\Support\Image as ImageSupport;

class ImageObserver
{
    /**
     * Handle the image "creating" event.
     *
     * @param  \App\Models\Image  $image
     *
     * @return void
     */
    public function creating(Image $image): void
    {
        $image->breakpoint = ImageSupport::breakpoint($image);
    }

    /**
     * Handle the image "updating" event.
     *
     * @param  \App\Models\Image  $image
     *
     * @return void
     */
    public function updating(Image $image): void
    {
        $will_calculate_breakpoint = false;

        if ($image->orientation === ImageOrientation::Landscape) {
            if ($image->isDirty('width')) {
                $will_calculate_breakpoint = true;
            }
        } else if ($image->orientation === ImageOrientation::Portrait) {
            if ($image->isDirty('height')) {
                $will_calculate_breakpoint = true;
            }
        }

        if ($will_calculate_breakpoint) {
            $image->breakpoint = ImageSupport::breakpoint($image);
        }
    }
}
