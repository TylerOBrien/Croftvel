<?php

namespace App\Http\Requests\Api\v1\Profile;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Profile;
use App\Traits\Requests\Api\v1\HasOwnership;

class UpdateProfile extends ApiRequest
{
    use HasOwnership;

    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'update';
        $this->binding = 'profile';
        $this->model = Profile::class;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        [ $owner_id, $owner_type ] = $this->owner();

        return [
            'owner_id' => 'sometimes|required_with:owner_type|morphable',
            'owner_type' => 'sometimes|required_with:owner_id|morphable',
            'name' => "string|unique:profiles,name,$owner_id,owner_id,$owner_type,owner_type"
        ];
    }
}
