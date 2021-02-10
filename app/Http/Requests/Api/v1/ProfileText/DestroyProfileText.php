<?php

namespace App\Http\Requests\Api\v1\ProfileText;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\ProfileText;

class DestroyProfileText extends ApiRequest
{
    /**
     * Create a new request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'destroy';
        $this->binding = 'profile_text';
        $this->model = ProfileText::class;
    }
}
