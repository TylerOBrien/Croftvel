<?php

namespace App\Traits\Models;

use App\Models\Address;

trait HasAddress
{
    /**
     * @return HasMany
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'owner');
    }

    /**
     * @return Address
     */
    public function createAddress(array $fields):Address
    {
        return Address::create(
            array_merge($fields['address'],
                [ 'owner_id' => $this->id,
                  'owner_type' => self::class ])
        );
    }

    /**
     * @return Address
     */
    public function updateOrCreateAddress(array $fields):Address
    {
        $predicate = [
            'name' => $fields['address']['name'],
            'owner_id' => $this->id,
            'owner_type' => self::class ];

        $address = Address::where($predicate)->limit(1)->first();

        if ($address) {
            return $address->fill($fields['address'])->save();
        }

        return $this->createAddress($fields);
    }
}
