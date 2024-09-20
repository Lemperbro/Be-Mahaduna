<?php

namespace App\Http\Resources\Artikel;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArtikelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'artikel_id' => $this->artikel_id,
            'judul' => $this->judul,
            'slug' => $this->slug,
            'kategori' => ArtikelKategoriResource::collection($this->whenLoaded('artikel_relasi')),
            'bannerImage' => url('/') . '/' . $this->bannerImage,
            'isi' => $this->isi,
            'views' => $this->views,
            'user_created' => $this->user_created ?? null,
            'created_at' => $this->created_at ?? null,
            'updated_at' => $this->updated_at ?? null,
            'user_updated' => $this->user_updated,
            'deleted_at' => $this->deleted_at ?? null,
            'user_deleted' => $this->user_deleted ?? null,
            'deleted' => $this->deleted ?? null
        ];
    }
}
