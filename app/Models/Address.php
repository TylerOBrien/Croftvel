<?php

namespace App\Models;

use App\Traits\Models\HasOwnership;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasOwnership;

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */

    protected $visible = [
        'id',
        'name',
        'line1',
        'line2',
        'city',
        'subdivision',
        'country',
        'postal_code',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'line1',
        'line2',
        'city',
        'subdivision',
        'country',
        'postal_code',
        'owner_id',
        'owner_type',
    ];
}
