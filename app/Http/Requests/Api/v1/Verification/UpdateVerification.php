<?php

namespace App\Http\Requests\Api\v1\Verification;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Verification;

class UpdateVerification extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'verification';
        $this->model = Verification::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'identity_id' => 'int|exists:identities,id',
            'code' => 'required|exists:verifications,code',
            'touch' => 'required|in:verified_at'
        ];
    }
}
