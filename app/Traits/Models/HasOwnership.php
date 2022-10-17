<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasOwnership
{
    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Retrieve the owner of this resource.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function owner()
    {
        return $this->morphTo();
    }

    /*
    |--------------------------------------------------------------------------
    | Attributes
    |--------------------------------------------------------------------------
    */

    /**
     * Ensure passed type has correct prefix and assign it.
     *
     * @param  string  $owner_type  The string version of the class name.
     *
     * @return void
     */
    public function setOwnerTypeAttribute(string $owner_type)
    {
        $this->attributes['owner_type'] = Str::start($owner_type, config('models.namespace'));
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Attempts to retrieve an instance of this model that has the given name
     * and is owned by the given owner resource. It is assumed that the name
     * is unique. If there are multiple rows with the same name and owner then
     * only the first row found will be returned.
     *
     * If a name is not specified then the default name set in the config will
     * be used.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $owner  The resource that owns the model instance to be found.
     * @param  string|null  $name  The name of the model instance to be found.
     *
     * @return self|null
     */
    static public function findFromOwner(Model $owner, string|null $name = null): self|null
    {
        $predicate = [
            'name' => $name ?? config('models.default.name'),
            'owner_id' => $owner->id,
            'owner_type' => $owner::class,
        ];

        return self::where($predicate)->first();
    }
}
