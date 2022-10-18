<?php

namespace App\Schemas\Image;

use App\Schemas\Schema;

class ImageSchema extends Schema
{
    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'disk' => 'required|string'.join(',', config('enum.upload.disk')),
            'breakpoint' => 'required|string|in:'.join(',', config('enum.image.breakpoint')),
            'orientation' => 'required|string|in:'.join(',', config('enum.image.orientation')),
            'width' => 'required|int',
            'height' => 'required|int',
            'filesize' => 'required|int',
            'owner_id' => 'required|int',
            'owner_type' => 'required|string',
        ];
    }
}
