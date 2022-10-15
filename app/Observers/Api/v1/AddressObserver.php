<?php

namespace App\Observers\Api\v1;

use App\Models\Address;
use App\Schemas\Address\AddressSchema;

class AddressObserver
{
    /**
     * Handle the address "updating" event.
     *
     * @param  \App\Models\Address  $address
     *
     * @return void
     */
    public function updating(Address $address): void
    {
        (new AddressSchema)->validate($address->getDirty());
    }
}
