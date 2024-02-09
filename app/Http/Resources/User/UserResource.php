<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => 'success',
            'code' => 200,
            'items' => [
                'image' => $this->image,
                'username' => $this->username,
                'email' => $this->email,
                'telp' => '0'.$this->telp,
                'role' => $this->role
            ]
        ];
    }
}
