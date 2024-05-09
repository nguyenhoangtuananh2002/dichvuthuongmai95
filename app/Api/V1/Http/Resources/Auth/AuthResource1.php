<?php

namespace App\Api\V1\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource1 extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'gender' => $this->gender,
            'roles' => $this->roles,
            'created_at' => $this->created_at,
        ];
    }
}
