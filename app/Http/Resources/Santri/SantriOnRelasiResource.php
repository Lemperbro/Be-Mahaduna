<?php

namespace App\Http\Resources\Santri;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SantriOnRelasiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'santri_id' => $this->santri->santri_id,
            'nama' => $this->santri->nama,
            'nisn' => $this->santri->nisn,
            'jenjang' => $this->santri->jenjang->jenjang,
            'tgl_masuk' => $this->santri->tgl_masuk,
            'jenis_kelamin' => $this->santri->jenis_kelamin,
            'status' => $this->santri->status,
            'created_at' => $this->santri->created_at,
        ];
    }
}
