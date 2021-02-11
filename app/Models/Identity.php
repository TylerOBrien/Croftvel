<?php

namespace App\Models;

use App\Events\Api\v1\Identity\{ IdentityCreated, IdentityVerified };
use App\Exceptions\Api\v1\Identity\{ AlreadyVerified, ExpiredVerificationCode, InvalidVerificationCode, MissingVerificationCode };

use Illuminate\Database\Eloquent\Model;

class Identity extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'type',
        'value'
    ];

    protected $casts = [
        'verified_at' => 'datetime'
    ];

    protected $dispatchesEvents = [
        'created' => IdentityCreated::class
    ];

    /**
     * @return HasOne
     */
    public function oauth_token()
    {
        return $this->hasOne(OAuthToken::class);
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasOne
     */
    public function verification()
    {
        return $this->hasOne(Verification::class);
    }

    /**
     * @return bool
     */
    public function attemptVerify(array $fields)
    {
        if ($this->verified) {
            throw new AlreadyVerified;
        }

        if (!isset($fields['code'])) {
            throw new MissingVerificationCode;
        }

        if ($this->verification->code !== hash('sha256', $fields['code'])) {
            throw new InvalidVerificationCode;
        }

        $now = now();

        if ($this->verification->created_at->diffInMinutes($now) > config('croft.verification.ttl')) {
            throw new ExpiredVerificationCode;
        }

        $this->verified_at = $now;
        
        return $this->save();
    }

    /**
     * @return bool
     */
    public function getVerifiedAttribute()
    {
        return (bool) $this->verified_at;
    }

    /**
     * @return void
     */
    public function setVerifiedAtAttribute($value)
    {
        if (is_null($this->verified_at)) {
            $this->attributes['verified_at'] = $value;
        }
    }

    /**
     * Register the updating callback to detect when this identity is verified.
     * 
     * @return void
     */
    static public function boot()
    {
        parent::boot();
        self::updated(function(Identity $identity) {
            if (in_array('verified_at', $identity->getChanges())) {
                event(new IdentityVerified($identity));
            } 
        });
    }
}
