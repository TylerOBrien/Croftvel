<?php

namespace App\Http\Requests\Api\v1\ProfileText;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileText;

class ShowProfileText extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'show';
        $this->binding = 'profile_text';
        $this->model = ProfileText::class;
    }
}
