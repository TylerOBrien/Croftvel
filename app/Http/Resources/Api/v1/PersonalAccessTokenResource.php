<?php

namespace App\Http\Resources\Api\v1;

use App\Helpers\Token\PersonalAccessTokenHelper;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonalAccessTokenResource extends JsonResource
{
    /**
     * Instantiate the resource.
     *
     * @param  \App\Helpers\Token\PersonalAccessTokenHelper  $patHelper
     *
     * @return void
     */
    public function __construct(PersonalAccessTokenHelper $patHelper)
    {
        parent::__construct($patHelper);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'value' => 'Bearer ' .  $this->pat->id . '|' . $this->plaintext,
            'ttl' => config('security.token.ttl'),
            'ttl_type' => 'minute',
            'created_at' => $this->pat->created_at,
        ];
    }
}
