<?php

namespace App\Http\Requests\Api\v1\Privilege;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Privilege;

class DestroyPrivilege extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'privilege';
        $this->model = Privilege::class;
    }
}
