<?php

namespace App\Http\Requests\Api\v1\Recovery;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Recovery;

class StoreRecovery extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
        $this->model = Recovery::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'identity_id' => 'required|int|exists:identities,id'
        ];
    }
}
