<?php

namespace App\Traits\Requests\Api\v1;

trait HasAddress
{
    /**
     * Get the store validation rules that apply to the request.
     *
     * @param  string  $prefix  The optional prefix to add to the names of each field in the address.
     *
     * @return array
     */
    protected function addressStoreRules(string $prefix = '') : array
    {
        return [
            "{$prefix}line1" => 'nullable|string',
            "{$prefix}line2" => 'nullable|string',
            "{$prefix}city" => 'nullable|string',
            "{$prefix}subdivision" => 'required|string|size:2|subdivision',
            "{$prefix}country" => 'required|string|size:2|country',
            "{$prefix}postal_code" => 'nullable|string'
        ];
    }

    /**
     * Get the update validation rules that apply to the request.
     *
     * @param  string  $prefix  The optional prefix to add to the names of each field in the address.
     *
     * @return array
     */
    protected function addressUpdateRules(string $prefix = '') : array
    {
        return [
            "{$prefix}line1" => 'nullable|string',
            "{$prefix}line2" => 'nullable|string',
            "{$prefix}city" => 'nullable|string',
            "{$prefix}subdivision" => 'string|size:2|subdivision',
            "{$prefix}country" => 'string|size:2|country',
            "{$prefix}postal_code" => 'nullable|string'
        ];
    }
}
