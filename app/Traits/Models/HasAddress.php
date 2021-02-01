<?php

namespace App\Traits\Models;

use App\Models\Address;

trait HasAddress
{
    /**
     * 
     */
    public function address()
    {
        return $this->hasOne(Address::class, 'owner_id')
                    ->where('owner_type', self::class);
    }

    /**
     * 
     */
    public function createAddress(array $fields)
    {
        return Address::create(
            array_merge($fields['address'],
                [ 'owner_id' => $this->id,
                  'owner_type' => self::class ])
        );
    }

    /**
     * 
     */
    public function updateOrCreateAddress(array $fields)
    {
        if ($this->address) {
            $this->address->fill($fields['address'])->save();
            return $this->address;
        }

        return $this->createAddress($fields);
    }
}
