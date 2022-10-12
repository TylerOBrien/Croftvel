<?php

namespace App\Http\Requests\Api\v1\User;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\User;

class UpdateUser extends ApiRequest
{
    /**
     * Instantiate the request.
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'user';
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
            'account_id' => 'sometimes|int|exists:accounts,id',
        ];
    }
}
