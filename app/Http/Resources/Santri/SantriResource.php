<?php

namespace App\Http\Resources\Santri;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SantriResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'santri_id' => $this->santri_id,
            'nama' => $this->nama,
            'nisn' => $this->nisn,
            'jenjang' => JenjangResource::make($this->whenLoaded('jenjang')),
            'tgl_masuk' => $this->tgl_masuk,
            'jenis_kelamin' => $this->jenis_kelamin,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
