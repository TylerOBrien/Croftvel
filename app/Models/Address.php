<?php

namespace App\Models;

use App\Traits\Models\{ HasOwnership, HasUserRevisions };

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasOwnership, HasUserRevisions;

    protected $hidden = [
        'owner_id',
        'owner_type'
    ];

    protected $fillable = [
        'line1',
        'line2',
        'city',
        'province',
        'country',
        'postal_code',
        'owner_id',
        'owner_type'
    ];
}
