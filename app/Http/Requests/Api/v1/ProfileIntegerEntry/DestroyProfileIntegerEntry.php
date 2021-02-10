<?php

namespace App\Http\Requests\Api\v1\ProfileIntegerEntry;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileIntegerEntry;

class DestroyProfileIntegerEntry extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'profile_integer_entry';
        $this->model = ProfileIntegerEntry::class;
    }
}
