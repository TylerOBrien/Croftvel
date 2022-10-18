<?php

namespace App\Support;

use App\Enums\Image\{ ImageBreakpoint, ImageOrientation };
use App\Models\Image as ImageModel;

class Image
{
    /**
     * Returns the appropriate ImageBreakpoint enum for the given model based
     * on its width if in landscape orientation or based on its height if in
     * landscape orientation.
     *
     * @param  \App\Models\Image  $image  The image instance to determine the size of.
     *
     * @return \App\Enums\Image\ImageBreakpoint
     */
    static public function breakpoint(ImageModel $image): ImageBreakpoint
    {
        $breakpoints = config('image.breakpoints.'.$image->orientation->value);
        $attribute = match ($image->orientation) {
            ImageOrientation::Landscape => 'width',
            ImageOrientation::Portrait => 'height',
        };

        if ($image->{$attribute} < $breakpoints[ImageBreakpoint::XS->value]) {
            return ImageBreakpoint::XS;
        } else if ($image->{$attribute} < $breakpoints[ImageBreakpoint::SM->value]) {
            return ImageBreakpoint::SM;
        } else if ($image->{$attribute} < $breakpoints[ImageBreakpoint::MD->value]) {
            return ImageBreakpoint::MD;
        } else if ($image->{$attribute} < $breakpoints[ImageBreakpoint::LG->value]) {
            return ImageBreakpoint::LG;
        }

        return ImageBreakpoint::XL;
    }
}
