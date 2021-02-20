<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id'        => $this->id,
            'nama'      => ucfirst($this->nama),
            'username'  => $this->username,
            'email'     => $this->email,
            'api_token' => $this->api_token,
            'is_admin'  => $this->is_admin,
        ];
    }
}
