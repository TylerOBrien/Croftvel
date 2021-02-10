<?php

namespace App\Http\Requests\Api\v1\ProfileFloatEntry;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileFloatEntry;

class ShowProfileFloatEntry extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'show';
        $this->binding = 'profile_float_entry';
        $this->model = ProfileFloatEntry::class;
    }
}
