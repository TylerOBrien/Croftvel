<?php

namespace App\Models;

use App\Events\Api\v1\Recovery\RecoveryCreated;
use App\Traits\Models\{ HasSecretCode, HasUniqueMaker };

use Illuminate\Database\Eloquent\Model;

class Recovery extends Model
{
    use HasSecretCode, HasUniqueMaker;

    protected $hidden = [
        'code',
    ];

    protected $fillable = [
        'identity_id',
        'code',
    ];

    protected $dispatchesEvents = [
        'created' => RecoveryCreated::class,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function identity()
    {
        return $this->belongsTo(Identity::class);
    }
}
