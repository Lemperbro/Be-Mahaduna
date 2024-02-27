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
            'kategori' => $this->artikel_kategori->kategori,
            'user_created' => $this->artikel_kategori->user_created ?? null,
            'created_at' => $this->artikel_kategori->created_at ?? null,
            'updated_at' => $this->artikel_kategori->updated_at ?? null,
            'user_updated' => $this->artikel_kategori->user_updated,
            'deleted_at' => $this->artikel_kategori->deleted_at ?? null,
            'user_deleted' => $this->artikel_kategori->user_deleted ?? null,
            'deleted' => $this->artikel_kategori->deleted ?? null
        ];
    }
}
