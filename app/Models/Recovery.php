<?php

namespace App\Models;

use App\Events\Api\v1\Recovery\CreatedRecovery;
use App\Traits\Models\HasUniqueMaker;

use Illuminate\Database\Eloquent\Model;

class Recovery extends Model
{
    use HasUniqueMaker;

    protected $temporary_plaintext_code;
    
    protected $hidden = [
        'code'
    ];

    protected $fillable = [
        'identity_id',
        'code'
    ];

    protected $dispatchesEvents = [
        'created' => CreatedRecovery::class
    ];

    /**
     * @return BelongsTo
     */
    public function identity()
    {
        return $this->belongsTo(Identity::class);
    }

    /**
     * @return string|null
     */
    public function consumePlaintextCode()
    {
        $code = $this->temporary_plaintext_code;
        unset($this->temporary_plaintext_code);
        return $code;
    }

    /**
     * @return void
     */
    public function setCodeAttribute(string $code)
    {
        $this->temporary_plaintext_code = $code;
        $this->attributes['code'] = hash('sha256', $code);
    }
}
