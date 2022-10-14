<?php

namespace App\Models;

use App\Events\Api\v1\Video\VideoCreated;
use App\Traits\Models\{ HasFileUpload, HasOwnership };

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Video extends Model
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
        'owner_id',
        'owner_type',
    ];

    protected $dispatchesEvents = [
        'created' => VideoCreated::class,
    ];

    /**
     * Create a new Video model from an uploaded file.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  array  $attributes
     *
     * @return \App\Models\Video
     */
    static public function createFromFile(UploadedFile $file, array $attributes) : Video
    {
        return self::createFromFileBase($file, $attributes, config('uploads.video.dest'));
    }

    /**
     * Modify an existing Video model using an uploaded file.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  array  $attributes
     *
     * @return bool
     */
    public function updateFromFile(UploadedFile $file, array $attributes) : bool
    {
        return call_user_func(
            [ $this, 'updateFromFileBase' ],
            $file,
            $attributes,
            config('uploads.video.dest'),
        );
    }
}
