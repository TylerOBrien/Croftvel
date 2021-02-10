<?php

namespace App\Http\Requests\Api\v1\Account;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Account;

class StoreAccount extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = Account::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
