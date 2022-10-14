<?php

namespace App\Traits\Models;

use Illuminate\Support\Collection;

trait HasLogo
{
    use HasImages;

    /**
     * @return \Illuminate\Support\Collection|null
     */
    public function getLogoAttribute() : Collection
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
}
