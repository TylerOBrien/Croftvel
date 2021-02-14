<?php

namespace App\Http\Requests\Api\v1\User;

use App\Models\User;
use App\Http\Requests\Api\v1\ApiRequest;

class StoreUser extends ApiRequest
{
    /**
     * Create a new request.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
        $this->model = User::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'account_id' => 'sometimes|int|exists:accounts,id|can:attach,Account'
        ];
    }
}
