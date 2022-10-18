<?php

namespace App\Http\Requests\Api\v1\Identity;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Identity;

class UpdateIdentity extends ApiRequest
{
    /**
     * Create a new request.
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
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string',
            'current_secret' => 'required|array',
            'current_secret.type' => 'required|string|in:' . join(',', config('enum.secret.type')),
            'current_secret.value' => 'required|string',
        ];
    }
}
