<?php

namespace App\Http\Requests\Api\v1\Profile;

use App\Http\Requests\Api\v1\ApiRequest;
use App\Models\Profile;
use App\Traits\Requests\Api\v1\HasOwnership;

class StoreProfile extends ApiRequest
{
    use HasOwnership;

    /**
     * Instantiate the request.
     *
     * @return void
     */
    public function __construct()
    {
        $this->ability = 'store';
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
            'owner_id' => 'required|morphable',
            'owner_type' => 'required|morphable',
            'name' => "string|unique:profiles,name,$owner_id,owner_id,owner_type,$owner_type"
        ];
    }
}
