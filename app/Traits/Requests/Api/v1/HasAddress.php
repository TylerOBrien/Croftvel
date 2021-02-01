<?php

namespace App\Traits\Requests\Api\v1;

trait HasAddress
{
    /**
     * 
     */
    protected function addressStoreRules()
    {
        return [
            'address.line1' => 'required|string',
            'address.line2' => 'nullable|string',
            'address.city' => 'required|string',
            'address.province' => 'required|string|size:2|province',
            'address.country' => 'required|string|size:2|country',
            'address.postal_code' => 'required|string'
        ];
    }

    /**
     * 
     */
    protected function addressUpdateRules()
    {
        return [
            'address.line1' => 'string',
            'address.line2' => 'nullable|string',
            'address.city' => 'string',
            'address.province' => 'string|size:2|province',
            'address.country' => 'string|size:2|country',
            'address.postal_code' => 'string'
        ];
    }
}
