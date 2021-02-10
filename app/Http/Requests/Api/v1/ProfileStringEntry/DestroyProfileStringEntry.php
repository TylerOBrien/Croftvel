<?php

namespace App\Http\Requests\Api\v1\ProfileStringEntry;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileStringEntry;

class DestroyProfileStringEntry extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'profile_string_entry';
        $this->model = ProfileStringEntry::class;
    }
}
