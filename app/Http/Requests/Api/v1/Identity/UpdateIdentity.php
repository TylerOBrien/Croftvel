<?php

namespace App\Http\Requests\Api\v1\Identity;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Identity;

class UpdateIdentity extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'identity';
        $this->model = Identity::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
