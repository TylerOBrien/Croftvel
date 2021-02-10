<?php

namespace App\Models;

use App\Traits\Models\{ HasFileUpload, HasOwnership };

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasOwnership;
    use HasFileUpload { 
        createFromFile as protected createFromFileBase;
    }

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

    /**
     * @return File
     */
    static public function createFromFile(array $attributes, $file)
    {
        return self::createFromFileBase($file, $attributes, config('croft.uploads.files.dir'));
    }

    /**
     * @return File
     */
    public function updateFromFile(array $attributes, $file)
    {
        return parent::updateFromFile($file, $attributes, config('croft.uploads.files.dir'));
    }
}
