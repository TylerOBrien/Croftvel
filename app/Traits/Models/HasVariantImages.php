<?php

namespace App\Traits\Models;

use App\Enums\Image\ImageSize;
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
     * @return \Illuminate\Support\Collection|null
     */
    public function imageVariantURLs(string $category): Collection
    {
        $category = str_replace('%', '\\%', $category);
        $images = $this->images()->where('name', 'like', $category.'.%.%')->get();
        $variants = collect([]);

        foreach ($images as $image) {
            [ $_, $name, $size ] = explode('.', $image->name);

            if (!$variants->has($name)) {
                $variants[$name] = collect([ $size => $image->url ]);
            } else {
                $variants[$name][$size] = $image->url;
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
     * @param  \App\Enums\Image\ImageSize  $name  The size of the image variant.
     *
     * @return \App\Models\Image
     */
    public function createImageVariant(UploadedFile $file, string $category, string $name, ImageSize $size): Image
    {
        return Image::createFromFile($file, [
            'name' => $category.'.'.$name.'.'.$size->value,
            'owner_id' => $this->id,
            'owner_type' => $this::class,
        ]);
    }
}
