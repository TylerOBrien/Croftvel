<?php

namespace App\Http\Resources\Api\v1\OAuth;

use Illuminate\Http\Resources\Json\JsonResource;

class OAuthUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'token' => $this->token,
        ];
    }
}
