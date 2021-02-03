<?php

namespace App\Models;

use App\Traits\Models\{ HasFileUpload, HasOwnership, HasUserRevisions };

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasOwnership, HasUserRevisions;
    use HasFileUpload { 
        createFromFile as protected createFromFileBase;
        updateFromFile as protected updateFromFileBase;
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
     * @return $this
     */
    public function updateFromFile(array $attributes, $file)
    {
        return self::updateFromFileBase($this, config('croft.uploads.dir.files'), $file, $attributes);
    }

    /**
     * @return File
     */
    static public function createFromFile(array $attributes, $file)
    {
        return self::createFromFileBase(config('croft.uploads.dir.files'), $file, $attributes);
    }
}
