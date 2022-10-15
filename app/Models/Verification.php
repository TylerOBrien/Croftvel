<?php

namespace App\Models;

use App\Events\Api\v1\Verification\VerificationCreated;
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
                $verification->code = self::makeUniqueInt(
                    'code',
                    config('security.verification.length'),
                    $verification->hash_algo,
                );
            }
        });
    }
}
