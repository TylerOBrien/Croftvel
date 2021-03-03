<?php

namespace App\Models;

use App\Traits\Models\HasOwnership;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasOwnership;

    protected $hidden = [
        'owner_id',
        'owner_type'
    ];

    protected $fillable = [
        'name',
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
