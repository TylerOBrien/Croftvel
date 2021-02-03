<?php

namespace App\Http\Requests\Api\v1\Meta;

use App\Models\Meta;
use App\Http\Requests\Api\v1\ApiRequest;
use App\Traits\Requests\Api\v1\HasOwnership;

class StoreMeta extends ApiRequest
{
    use HasOwnership;

    /**
     * Instantiate the request.
     */
    public function __construct()
    {
        $this->ability = 'store';
        $this->model = Meta::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(
            [
                'name' => 'required|string'
            ],
            $this->ownershipStoreRules()
        );
    }
}
