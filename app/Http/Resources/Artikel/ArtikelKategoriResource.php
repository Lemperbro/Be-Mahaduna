<?php

namespace App\Http\Resources\Artikel;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArtikelKategoriResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'kategori_id' => $this->artikel_kategori->artikel_kategori_id,
            'kategori' => $this->artikel_kategori->kategori
        ];
    }

}
