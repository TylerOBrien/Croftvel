<?php

namespace App\Http\Requests\Api\v1\Privilege;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Privilege;

class ShowPrivilege extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'show';
        $this->binding = 'privilege';
        $this->model = Privilege::class;
    }
}
