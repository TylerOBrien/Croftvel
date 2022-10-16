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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function verifiable()
    {
        return $this->morphTo();
    }

    /**
     * Generate a new unique verification code.
     *
     * @return int
     */
    public function generate(): int
    {
        if (is_null($this->hash_algo)) {
            throw new MissingHashAlgo;
        }

        return self::makeUniqueInt(
            'code',
            config('security.verification.length'),
            $this->hash_algo,
        );
    }

    /**
     * Register creating handler to ensure that a code is created if one has
     * not already been provided.
     *
     * @return void
     */
    static public function boot(): void
    {
        parent::boot();
        self::creating(function (Verification $verification) {
            if (is_null($verification->hash_algo)) {
                $verification->hash_algo = config('security.verification.hash_algo');
            }

            if (is_null($verification->code)) {
                $verification->code = $verification->generate();
            }
        });
    }
}
