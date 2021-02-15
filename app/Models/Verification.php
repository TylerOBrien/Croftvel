<?php

namespace App\Models;

use App\Events\Api\v1\Verification\VerificationCreated;
use App\Traits\Models\{ HasUniqueCode, HasUniqueMaker };

use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    use HasUniqueCode, HasUniqueMaker;

    protected $hidden = [
        'code'
    ];

    protected $fillable = [
        'identity_id',
        'code'
    ];

    protected $dispatchesEvents = [
        'created' => VerificationCreated::class
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function identity()
    {
        return $this->belongsTo(Identity::class);
    }
}
