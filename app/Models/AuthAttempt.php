<?php

namespace App\Models;

use App\Events\Api\v1\Auth\AuthAttemptCreated;

use Illuminate\Database\Eloquent\Model;

class AuthAttempt extends Model
{
    protected $fillable = [
        'identity_type',
        'identity_value',
        'is_success',
    ];

    protected $casts = [
        'is_success' => 'boolean',
    ];

    protected $dispatchesEvents = [
        'created' => AuthAttemptCreated::class,
    ];
}
