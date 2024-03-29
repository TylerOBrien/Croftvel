<?php

namespace App\Models;

use App\Events\Api\v1\Auth\AuthAttemptCreated;

use Illuminate\Database\Eloquent\{ Builder, Model };

class AuthAttempt extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */

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

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Builds a query constraining all AuthAttempt rows to the passed Identity.
     *
     * @param  \App\Models\Identity  $identity  The identity instance to lookup auth attempts for.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    static public function fromIdentity(Identity $identity): Builder
    {
        return self::where('identity_type', $identity->type)
                   ->where('identity_value', $identity->value);
    }
}
