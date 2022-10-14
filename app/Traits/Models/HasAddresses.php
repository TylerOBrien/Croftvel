<?php

namespace App\Traits\Models;

use App\Models\Address;

trait HasAddresses
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'owner');
    }

    /**
     * @param  array  $fields  The attributes to pass to the create function.
     *
     * @return \App\Models\Address
     */
    public function createAddress(array $attributes) : Address
    {
        return Address::create(
            array_merge($attributes, [
                'owner_id' => $this->id,
                'owner_type' => self::class,
            ])
        );
    }

    /**
     * @param  array  $attributes  The attributes to pass to the create/update function.
     *
     * @return \App\Models\Address|bool
     */
    public function updateOrCreateAddress(array $attributes) : Address|null
    {
        $predicate = [
            'name' => $attributes['name'],
            'owner_id' => $this->id,
            'owner_type' => self::class,
        ];

        $address = Address::where($predicate)->first();

        if ($address) {
            return $address->fill($attributes)->save();
        }

        return $this->createAddress($attributes);
    }
}
