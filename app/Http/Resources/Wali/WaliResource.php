<?php

namespace App\Http\Resources\Wali;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WaliResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'wali_id' => $this->wali_id,
            'nama' => $this->nama,
            'email' => $this->email,
            'alamat' => $this->alamat,
            'telp' => $this->telp
        ];
    }
}
