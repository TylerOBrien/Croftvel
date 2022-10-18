<?php

namespace App\Observers\Api\v1;

use App\Enums\Image\ImageOrientation;
use App\Models\Image;
use App\Schemas\Image\ImageSchema;
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
        ImageSchema::validated($image->getDirty());

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
        $fields = ImageSchema::validated($image->getDirty());
        $will_calculate_breakpoint = match ($image->orientation) {
            ImageOrientation::Landscape => isset($fields['width']),
            ImageOrientation::Portrait => isset($fields['height']),
        };

        if ($will_calculate_breakpoint) {
            $image->breakpoint = ImageSupport::breakpoint($image);
        }
    }
}
