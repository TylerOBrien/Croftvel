<?php

namespace App\Models;

use App\Enums\Image\{ ImageBreakpoint, ImageOrientation };
use App\Events\Api\v1\Image\ImageCreated;
use App\Support\Image as ImageSupport;
use App\Traits\Models\{ HasFileUpload, HasOwnership };

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Image extends Model
{
    use HasOwnership;
    use HasFileUpload {
        createFromFile as protected createFromFileBase;
        updateFromFile as protected updateFromFileBase;
    }

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */

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
        'orientation',
        'width',
        'height',
        'owner_id',
        'owner_type',
    ];

    protected $dispatchesEvents = [
        'breakpoint' => ImageBreakpoint::class,
        'orientation' => ImageOrientation::class,
        'created' => ImageCreated::class,
    ];

    /*
    |--------------------------------------------------------------------------
    | Image
    |--------------------------------------------------------------------------
    */

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function breakpoint(): Attribute
    {
        return Attribute::make(
            get: fn () => ImageSupport::breakpoint($this),
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Create a new Image model from an uploaded file.
     *
     * @param  \Illuminate\Http\UploadedFile  $file  The file uploaded by a user.
     * @param  array  $fields  The attributes passed to the create function, typically coming from a request.
     *
     * @return \App\Models\Image
     */
    static public function createFromFile(UploadedFile $file, array $fields): Image
    {
        [ $width, $height ] = getimagesize($file);

        $fields['width'] = $width;
        $fields['height'] = $height;

        return self::createFromFileBase($file, $fields, config('uploads.image.dest'));
    }

    /**
     * Modify an existing Image model using an uploaded file.
     *
     * @param  \Illuminate\Http\UploadedFile  $file  The file uploaded by a user.
     * @param  array  $fields  The attributes passed to the update function, typically coming from a request.
     *
     * @return bool
     */
    public function updateFromFile(UploadedFile $file, array $fields): bool
    {
        [ $width, $height ] = getimagesize($file);

        $fields['width'] = $width;
        $fields['height'] = $height;

        return call_user_func(
            [ $this, 'updateFromFileBase' ],
            $file,
            $fields,
            config('uploads.image.dest'),
        );
    }
}
