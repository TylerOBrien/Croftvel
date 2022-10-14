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
     * Create a new address with this model instance being set as the owner. The
     * given attributes will be passed to the Address::create function.
     *
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
     * Checks if an address matching the given attributes already exists. If so
     * that existing instance will be modified. Otherwise a new address will be
     * created with this model instance being set as the owner. The
     * given attributes will be passed to the Address::create function.
     *
     * Will return true if modifying an existing address.
     *
     * Will return an instance of the Address model if creating a new address.
     *
     * @param  array  $attributes  The attributes to pass to the create/update function.
     *
     * @return \App\Models\Address|bool
     */
    public function updateOrCreateAddress(array $attributes) : Address|bool
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
