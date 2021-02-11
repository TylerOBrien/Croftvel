<?php

namespace App\Models;

use App\Events\Api\v1\Image\ImageCreated;
use App\Traits\Models\{ HasFileUpload, HasOwnership };

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasOwnership;
    use HasFileUpload { 
        createFromFile as protected createFromFileBase;
    }

    protected $appends = [
        'url'
    ];

    protected $hidden = [
        'disk',
        'filepath',
        'owner_id',
        'owner_type'
    ];

    protected $fillable = [
        'disk',
        'name',
        'mimetype',
        'filepath',
        'filesize',
        'width',
        'height',
        'owner_id',
        'owner_type'
    ];

    protected $dispatchesEvents = [
        'created' => ImageCreated::class
    ];

    /**
     * @return Image
     */
    static public function createFromFile(array $attributes, $file)
    {
        [ $width, $height ] = getimagesize($file);

        $attributes['width'] = $width;
        $attributes['height'] = $height;

        return self::createFromFileBase($file, $attributes, config('croft.uploads.images.dir'));
    }

    /**
     * @return bool
     */
    public function updateFromFile(array $attributes, $file)
    {
        [ $width, $height ] = getimagesize($file);
        
        $attributes['width'] = $width;
        $attributes['height'] = $height;

        return parent::updateFromFile($file, $attributes, config('croft.uploads.images.dir'));
    }
}
