<?php

namespace App\Http\Resources\Artikel;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KategoriResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'kategori_id' => $this->artikel_kategori_id,
            'kategori' => $this->kategori,
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
