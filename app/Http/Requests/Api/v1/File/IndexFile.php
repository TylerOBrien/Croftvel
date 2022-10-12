<?php

namespace App\Http\Requests\Api\v1\File;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\File;
use App\Traits\Requests\Api\v1\HasRequestHelpers;

class IndexFile extends ApiRequest
{
    use HasRequestHelpers;

    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'index';
        $this->model = File::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->indexRules();
    }
}
