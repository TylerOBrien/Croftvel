<?php

namespace App\Models;

use App\Traits\Models\{ HasFileUpload, HasOwnership, HasUserRevisions };

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFileUpload, HasOwnership, HasUserRevisions;

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
}
