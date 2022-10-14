<?php

namespace App\Models;

use App\Events\Api\v1\File\FileCreated;
use App\Traits\Models\{ HasFileUpload, HasOwnership };

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class File extends Model
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
        'created' => FileCreated::class,
    ];

    /**
     * Create a new File model from an uploaded file.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  array  $attributes
     *
     * @return \App\Models\File
     */
    static public function createFromFile(UploadedFile $file, array $attributes) : File
    {
        return self::createFromFileBase($file, $attributes, config('uploads.file.dest'));
    }

    /**
     * Modify an existing File model using an uploaded file.
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
            config('uploads.file.dest'),
        );
    }
}
