<?php

namespace App\Http\Requests\Api\v1\ProfileTextEntry;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileTextEntry;

class DestroyProfileTextEntry extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'profile_text_entry';
        $this->model = ProfileTextEntry::class;
    }
}
