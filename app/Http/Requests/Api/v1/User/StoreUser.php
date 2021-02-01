<?php

namespace App\Http\Requests\Api\v1\User;

use App\Models\User;
use App\Http\Requests\Api\v1\ApiRequest;

use Illuminate\Validation\Rule;

class StoreUser extends ApiRequest
{
    /**
     * Instantiate the request.
     */
    public function __construct()
    {
        $this->ability = 'store';
        $this->model = User::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email,NULL,id,is_active,1',
            'type' => [ 'required', Rule::in(config('croft.enum.user.type')) ],
            'password' => 'required|string|min:8|confirmed'
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'type.required' => 'The user type is required.'
        ];
    }
}
