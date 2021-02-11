<?php

namespace App\Http\Requests\Api\v1\Recovery;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Recovery;

class IndexRecovery extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'index';
        $this->model = Recovery::class;
    }
}
