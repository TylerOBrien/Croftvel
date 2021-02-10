<?php

namespace App\Http\Requests\Api\v1\ProfileIntegerEntry;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileIntegerEntry;

class ShowProfileIntegerEntry extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'show';
        $this->binding = 'profile_integer_entry';
        $this->model = ProfileIntegerEntry::class;
    }
}
