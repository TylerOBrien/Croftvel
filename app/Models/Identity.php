<?php

namespace App\Models;

use App\Events\Api\v1\Identity\IdentityCreated;
use App\Exceptions\Api\v1\Auth\InvalidCredentials;
use App\Exceptions\Api\v1\Identity\IdentityAlreadyVerified;
use App\Traits\Models\HasVerify;

use Illuminate\Database\Eloquent\{ Collection, Model };

class Identity extends Model
{
    use HasVerify;

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'value',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    protected $dispatchesEvents = [
        'created' => IdentityCreated::class,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->user->account();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function oauth_token()
    {
        return $this->hasOne(OAuthAccessToken::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return bool
     */
    public function getIsVerifiedAttribute(): bool
    {
        return (bool) $this->verified_at;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAuthAttemptsAttribute(): Collection
    {
        return AuthAttempt::fromIdentity($this)->get();
    }

    /**
     * @return void
     */
    public function setVerifiedAtAttribute($value): void
    {
        if (is_null($this->verified_at)) {
            $this->attributes['verified_at'] = $value;
        } else {
            throw new IdentityAlreadyVerified;
        }
    }

    /**
     * Attempts to retrieve an instance of the Identity defined in the request.
     *
     * @param  array  $fields  The request fields containing the raw credentials data.
     *
     * @return \App\Models\Identity|null
     */
    static public function findFromFields(array $fields): Identity
    {
        if (isset($fields['identity_id'])) {
            return self::find($fields['identity_id']);
        }

        $type = $fields['identity']['type'] ?? null;
        $value = $fields['identity']['value'] ?? null;

        if (!$type || !$value) {
            return null;
        }

        return self::where(compact('type', 'value'))->first();
    }

    /**
     * Attempts to retrieve an instance of the Identity model defined in the request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \App\Models\Identity|null
     */
    static public function findFromRequest($request): Identity
    {
        if ($request->has('identity_id')) {
            return self::find($request->input('identity_id'));
        }

        $type = $request->input('type');
        $value = $request->input('value');

        return self::where(compact('type', 'value'))->first();
    }

    /**
     * Creates a new Identity model using the passed fields that are assumed
     * to have come from a request (e.g. a register request).
     *
     * @param  \App\Models\User  $user  The user to associate the new Identity with.
     * @param  array  $fields  The request fields containing the raw credentials data.
     *
     * @return \App\Models\Identity|null
     */
    static public function createFromFields(User $user, array $fields): Identity
    {
        if (!isset($fields['identity']) ||
            !is_array($fields['identity']) ||
            !isset($fields['identity']['type']) ||
            !isset($fields['identity']['value']))
        {
            throw new InvalidCredentials;
        }

        return self::create([
            'user_id' => $user->id,
            'type' => $fields['identity']['type'],
            'value' => $fields['identity']['value'],
        ]);
    }
}
