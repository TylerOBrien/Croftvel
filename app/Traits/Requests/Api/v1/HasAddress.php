<?php

namespace App\Traits\Requests\Api\v1;

trait HasAddress
{
    /**
     * Get the store validation rules that apply to the request.
     * 
     * @return array
     */
    protected function addressStoreRules(string $prefix='')
    {
        return [
            "{$prefix}line1" => 'nullable|string',
            "{$prefix}line2" => 'nullable|string',
            "{$prefix}city" => 'nullable|string',
            "{$prefix}province" => 'required|string|size:2|province',
            "{$prefix}country" => 'required|string|size:2|country',
            "{$prefix}postal_code" => 'nullable|string'
        ];
    }

    /**
     * Get the store validation rules that apply to the request.
     * 
     * @return array
     */
    protected function addressUpdateRules(string $prefix='')
    {
        return [
            "{$prefix}line1" => 'nullable|string',
            "{$prefix}line2" => 'nullable|string',
            "{$prefix}city" => 'nullable|string',
            "{$prefix}province" => 'string|size:2|province',
            "{$prefix}country" => 'string|size:2|country',
            "{$prefix}postal_code" => 'nullable|string'
        ];
    }
}
