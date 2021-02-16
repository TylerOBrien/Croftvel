<?php

namespace App\Traits\Models;

use App\Models\Address;

trait HasAddress
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'owner');
    }

    /**
     * @return \App\Models\Address
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
     * @return \App\Models\Address|bool
     */
    public function updateOrCreateAddress(array $fields)
    {
        $predicate = [
            'name' => $fields['address']['name'],
            'owner_id' => $this->id,
            'owner_type' => self::class ];

        $address = Address::where($predicate)->first();

        if ($address) {
            return $address->fill($fields['address'])->save();
        }

        return $this->createAddress($fields);
    }
}
