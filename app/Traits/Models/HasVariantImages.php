<?php

namespace App\Traits\Models;

use App\Models\Image;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

trait HasVariantImages
{
    use HasImages;

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Generate a Collection of all image variants indexed by the variant name
     * with each value being the URL of the image.
     *
     * @param  string  $category  The category of the image variants.
     *
     * @return \Illuminate\Support\Collection
     */
    public function imageVariantURLs(string $category): Collection
    {
        $category = str_replace('%', '\\%', $category);
        $images = $this->images()->where('name', 'like', $category.'.%')->get();
        $variants = collect([]);

        foreach ($images as $image) {
            [ $_, $name ] = explode('.', $image->name);

            if (!$variants->has($name)) {
                $variants[$name] = collect([ $image->breakpoint => $image->url ]);
            } else {
                $variants[$name][$image->breakpoint] = $image->url;
            }
        }

        return $variants;
    }

    /**
     * Create a new Image instance preconfigured to represent an avatar.
     *
     * @param  \Illuminate\Http\UploadedFile  $file  The image file uploaded by a user.
     * @param  string  $category  The category of the image variant.
     * @param  string  $name  The name of the image variant.
     *
     * @return \App\Models\Image
     */
    public function createImageVariant(UploadedFile $file, string $category, string $name): Image
    {
        return Image::createFromFile($file, [
            'name' => $category.'.'.$name,
            'owner_id' => $this->id,
            'owner_type' => $this::class,
        ]);
    }
}
