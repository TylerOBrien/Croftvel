<?php

namespace App\Models;

use App\Exceptions\Api\v1\Identity\{ AlreadyVerified, ExpiredVerificationCode, InvalidVerificationCode, MissingVerificationCode };
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Identity extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'value'
    ];

    protected $casts = [
        'verified_at' => 'datetime'
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
     * @return void
     */
    public function attemptVerify(array $fields)
    {
        if ($this->verified) {
            throw new AlreadyVerified;
        }

        if (!isset($fields['code'])) {
            throw new MissingVerificationCode;
        }

        if ($this->verification->code !== intval($fields['code'])) {
            throw new InvalidVerificationCode;
        }

        if ($this->verification->created_at->diffInMinutes(Carbon::now()) > config('croft.verification.ttl')) {
            throw new ExpiredVerificationCode;
        }

        $this->verified_at = Carbon::now();
        $this->save();
    }

    /**
     * @return bool
     */
    public function getVerifiedAttribute()
    {
        return (bool) $this->verified_at;
    }
}
