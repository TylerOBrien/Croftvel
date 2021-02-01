<?php

namespace App\Http\Requests\Api\v1\User;

use App\Models\User;
use App\Http\Requests\Api\v1\ApiRequest;
use App\Rules\MatchCurrentPassword;

use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class UpdateUser extends ApiRequest
{
    /**
     * Instantiate the request.
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'user';
        $this->model = User::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch (auth()->user()->type) {
        case 'Admin':
            return array_merge($this->getUserRules(), $this->getAdminRules());
        default:
            return $this->getUserRules();
        }
    }

    /**
     * @return array
     */
    public function getUserRules()
    {
        $current_id = $this->route('user')->id;

        return array_merge(
            [
                'email' => "email|unique:users,email,$current_id,id,is_active,1",
                'password' => 'confirmed|zxcvbn_min:2'
            ],
            $this->needsCurrentPassword()
                ? $this->getCurrentPasswordRules()
                : []
        );
    }

    /**
     * @return array
     */
    public function getAdminRules()
    {
        return [
            'is_active' => 'boolean',
            'type' => [ 'string', Rule::in(config('croft.enum.user.type')) ],
            'status' => [ 'string', Rule::in(config('croft.enum.user.status')) ]
        ];
    }

    /**
     * @return array
     */
    public function getCurrentPasswordRules()
    {
        return [
            'current_password' => [ 'required', 'string', new MatchCurrentPassword ]
        ];
    }

    /**
     * @return boolean
     */
    public function needsCurrentPassword()
    {
        if (!Request::has('password')) {
            return false;
        }

        if (Request::has('email')) {
            return Request::input('email') !== $this->route('user')->email;
        }

        return true;
    }
}
