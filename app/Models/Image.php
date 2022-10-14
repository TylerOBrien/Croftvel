<?php

namespace App\Models;

use App\Events\Api\v1\Image\ImageCreated;
use App\Traits\Models\{ HasFileUpload, HasOwnership };

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Image extends Model
{
    use HasOwnership;
    use HasFileUpload {
        createFromFile as protected createFromFileBase;
        updateFromFile as protected updateFromFileBase;
    }

    protected $appends = [
        'url',
    ];

    protected $hidden = [
        'disk',
        'filepath',
        'owner_id',
        'owner_type',
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
        'owner_type',
    ];

    protected $dispatchesEvents = [
        'created' => ImageCreated::class,
    ];

    /**
     * Create a new Image model from an uploaded file.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  array  $attributes
     *
     * @return \App\Models\Image
     */
    static public function createFromFile(UploadedFile $file, array $attributes) : Image
    {
        [ $width, $height ] = getimagesize($file);

        $attributes['width'] = $width;
        $attributes['height'] = $height;

        return self::createFromFileBase($file, $attributes, config('uploads.image.dest'));
    }

    /**
     * Modify an existing Image model using an uploaded file.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  array  $attributes
     *
     * @return bool
     */
    public function updateFromFile(UploadedFile $file, array $attributes) : bool
    {
        [ $width, $height ] = getimagesize($file);

        $attributes['width'] = $width;
        $attributes['height'] = $height;

        return call_user_func(
            [ $this, 'updateFromFileBase' ],
            $file,
            $attributes,
            config('uploads.image.dest'),
        );
    }
}
