<?php

namespace App\Models;

use App\Events\Api\v1\File\FileCreated;
use App\Traits\Models\{ HasFileUpload, HasOwnership };

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasOwnership;
    use HasFileUpload { 
        createFromFile as protected createFromFileBase;
        updateFromFile as protected updateFromFileBase;
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
        'owner_id',
        'owner_type'
    ];

    protected $dispatchesEvents = [
        'created' => FileCreated::class
    ];

    /**
     * @return \App\Models\File
     */
    static public function createFromFile($file, array $attributes)
    {
        return self::createFromFileBase($file, $attributes, config('croft.uploads.files.dir'));
    }

    /**
     * @return bool
     */
    public function updateFromFile($file, array $attributes)
    {
        return call_user_func([ $this, 'updateFromFileBase' ], $file, $attributes, config('croft.uploads.files.dir'));
    }
}
