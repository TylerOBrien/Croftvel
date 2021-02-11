<?php

namespace App\Models;

use App\Events\Api\v1\Token\TokenCreated;

use Illuminate\Database\Eloquent\Model;

class PersonalAccessToken extends Model
{
    protected $dispatchesEvents = [
        'created' => TokenCreated::class
    ];
}
