<?php

namespace App\Http\Requests\Api\v1\Identity;

use App\Guards\Api\v1\ApiGuard;
use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Identity;

class StoreIdentity extends ApiRequest
{
    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
        $this->model = Identity::class;
    }

    /**
     * Get the default values for fields that have not been provided.
     *
     * @return array<string, mixed>
     */
    public function defaults(): array
    {
        return [
            'user_id' => auth()->id(),
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $method_name = $this->input('type') . 'ValueRules';

        if (method_exists($this, $method_name)) {
            $value_rules = call_user_func([ $this, $method_name ]);
        } else {
            $value_rules = [];
        }

        // If no user_id is given that means the auth'd user is associating an
        // identity with themself.
        //
        // Check if this auth'd user is adding an additional identity.
        // If so they must provide a password for security reasons.

        if (!$this->has('user_id') && ApiGuard::get()->user()->identities()->first()) {
            $secret_rule = [
                'current_secret' => 'required|array',
                'current_secret.type' => 'required|string|in:' . join(',', config('enum.secret.type')),
                'current_secret.value' => 'required|string',
            ];
        } else {
            $secret_rule = [];
        }

        return array_merge($secret_rule, [
            'user_id' => 'sometimes|int|exists:users,id|can:attach_identity,User',
            'name' => 'required|string',
            'type' => 'required|in:' . join(',', config('enum.identity.type')),
            'value' => array_merge($value_rules, [
                'required',
                'unique:identities',
            ]),
        ]);
    }

    /**
     * Get the validation rules for email identities.
     *
     * @return array<string>
     */
    public function emailValueRules(): array
    {
        return ['email'];
    }

    /**
     * Get the validation rules for mobile identities.
     *
     * @return array<string>
     */
    public function mobileValueRules(): array
    {
        return ['phone_number'];
    }

    /**
     * Get the validation rules for oauth identities.
     *
     * @return array<string>
     */
    public function oauthValueRules(): array
    {
        return [''];
    }
}
