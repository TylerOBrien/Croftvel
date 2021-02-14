<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class TokenResource extends JsonResource
{
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
            'value' => 'Bearer ' . $this->plainTextToken,
            'ttl' => config('sanctum.expiration'),
            'ttl_type' => 'minute',
            'created_at' => $this->accessToken->created_at
        ];
    }
}
