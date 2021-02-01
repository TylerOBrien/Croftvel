<?php

namespace App\Models;

use App\Traits\Models\{ HasFileUpload, HasOwnership, HasUserRevisions };

use Illuminate\Database\Eloquent\Model;

class Image extends Model
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
        'width',
        'height',
        'owner_id',
        'owner_type'
    ];

    /**
     * 
     */
    public function updateFromFile(array $attributes, $file)
    {
        $imgsize = getimagesize($file);
        $attributes['width'] = $imgsize[0];
        $attributes['height'] = $imgsize[1];

        self::updateFromFileBase($this, config('croft.uploads.dir.images'), $file, $attributes);

        return $this;
    }

    /**
     * 
     */
    static public function createFromFile(array $attributes, $file)
    {
        $imgsize = getimagesize($file);
        $attributes['width'] = $imgsize[0];
        $attributes['height'] = $imgsize[1];

        return self::createFromFileBase(config('croft.uploads.dir.images'), $file, $attributes);
    }
}
