<?php

namespace App\Traits\Requests\Api\v1;

trait HasOwnership
{
    /**
     * Get the store validation rules that apply to the request.
     * 
     * @return array
     */
    protected function ownershipStoreRules()
    {
        return [
            'owner_id' => 'required|int',
            'owner_type' => 'required|string'
        ];
    }

    /**
     * Get the update validation rules that apply to the request.
     * 
     * @return array
     */
    protected function ownershipUpdateRules()
    {
        return [
            'owner_id' => 'int',
            'owner_type' => 'string'
        ];
    }
}
