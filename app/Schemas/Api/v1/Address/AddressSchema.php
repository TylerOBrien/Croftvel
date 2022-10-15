<?php

namespace App\Schemas\Api\v1\Address;

use App\Schemas\Schema;

class AddressSchema extends Schema
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'country' => 'required|country',
        ];
    }
}
