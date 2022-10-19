<?php

namespace App\Models;

use App\Enums\Verification\{ VerificationAbility, VerificationType };
use App\Events\Api\v1\Verification\VerificationCreated;
use App\Exceptions\Api\v1\Verification\MissingHashAlgo;
use App\Traits\Models\{ HasSecretCode, HasUniqueMaker };

use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    use HasSecretCode, HasUniqueMaker;

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */

    protected $hidden = [
        'code',
        'verifiable_id',
        'verifiable_type',
    ];

    protected $fillable = [
        'ability',
        'code',
        'hash_algo',
        'verifiable_id',
        'verifiable_type',
    ];

    protected $casts = [
        'type' => VerificationType::class,
        'ability' => VerificationAbility::class,
        'expires_at' => 'datetime',
    ];

    protected $dispatchesEvents = [
        'created' => VerificationCreated::class,
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function verifiable()
    {
        return $this->morphTo();
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Generate a new unique verification code. The generated code will not be
     * persisted in storage.
     *
     * @return int
     *
     * @throws \App\Exceptions\Api\v1\Verification\MissingHashAlgo
     */
    public function generate(): int
    {
        if (is_null($this->hash_algo)) {
            throw new MissingHashAlgo;
        }

        return self::makeUniqueInt(
            'code',
            config('verify.default.length'),
            $this->hash_algo,
        );
    }
}
