<?php

namespace App\Traits\Models;

use App\Models\Image;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

trait HasLogo
{
    use HasImages;

    /*
    |--------------------------------------------------------------------------
    | Attributes
    |--------------------------------------------------------------------------
    */

    /**
     * @return \Illuminate\Support\Collection|null
     */
    public function getLogoAttribute(): Collection
    {
        $images = $this->images()->where('name', 'like', 'logo.%.%')->get();
        $logoVariants = collect([]);

        foreach ($images as $image) {
            [ $_, $name, $size ] = explode('.', $image->name);

            if (!$logoVariants->has($name)) {
                $logoVariants[$name] = collect([ $size => $image->url ]);
            } else {
                $logoVariants[$name][$size] = $image->url;
            }
        }

        return $logoVariants;
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Create a new Image instance preconfigured to represent a logo.
     *
     * @param  \Illuminate\Http\UploadedFile  $file  The image file uploaded by a user.
     * @param  string|null  $name  The name of the logo.
     *
     * @return \App\Models\Image
     */
    public function createLogo(UploadedFile $file, string|null $name = null): Image
    {
        return Image::createFromFile($file, [
            'name' => 'logo'.($name ?? config('models.default.name')).'xl',
            'owner_id' => $this->id,
            'owner_type' => $this::class,
        ]);
    }
}
