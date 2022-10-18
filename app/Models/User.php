<?php

namespace App\Models;

use App\Events\Api\v1\User\UserCreated;
use App\Traits\Models\{ HasEnabledState, HasFullName, HasProfiles, HasUserAbilities, HasVariantImages };

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as BaseUser;
use Illuminate\Notifications\Notifiable;

class User extends BaseUser
{
    use Notifiable, HasFactory, HasEnabledState, HasFullName, HasUserAbilities, HasProfiles, HasVariantImages;

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */

    protected $appends = [
        'full_name',
        'reversed_full_name',
        'is_identified',
    ];

    protected $fillable = [
        'account_id',
        'first_name',
        'middle_name',
        'last_name',
        'is_enabled',
    ];

    protected $casts = [
        'last_active_at' => 'datetime',
        'identified_at' => 'datetime',
        'is_enabled' => 'boolean',
    ];

    protected $dispatchesEvents = [
        'created' => UserCreated::class,
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function identities()
    {
        return $this->hasMany(Identity::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function privileges()
    {
        return $this->belongsToMany(Privilege::class)
                    ->using(PrivilegeUser::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function secrets()
    {
        return $this->hasMany(Secret::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Attributes
    |--------------------------------------------------------------------------
    */

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function avatar(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->imageVariantURLs('avatar'),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function email(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->identityAttribute('email'),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function mobile(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->identityAttribute('mobile'),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function privilege(): Attribute
    {
        return Attribute::make(
            get: fn () => Privilege::whereName(config('permissions.privilege.name.pattern', $this->toArray()))->first(),
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    public function isIdentified(): Attribute
    {
        return Attribute::make(
            get: fn () => (bool) $this->identified_at,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Retreive the specified identity attribute.
     *
     * @param  string  $type  The type of identity (e.g. email or mobile) to lookup.
     * @param  string|null  $name  The name of the identity.
     *
     * @return string|null
     */
    protected function identityAttribute(string $type, string|null $name = null): string|null
    {
        $name = $name ?? config('models.default.name');

        return $this->identities()
                    ->where(compact('type', 'name'))
                    ->first()
                    ->value ?? null;
    }

    /**
     * Create a new user model with as well as a new account that the new user
     * will be associated with.
     *
     * @return \App\Models\User
     */
    static public function createWithAccount(): User
    {
        return self::create([
            'account_id' => Account::create()->id,
        ]);
    }
}
