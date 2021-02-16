<?php

namespace App\Http\Requests\Api\v1\Privilege;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Privilege;

class UpdatePrivilege extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'privilege';
        $this->model = Privilege::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'sometimes|string|unique:privileges,name'
        ];
    }
}
