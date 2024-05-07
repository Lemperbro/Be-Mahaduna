<?php

namespace App\Http\Resources\Store;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailProdukResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'produk_id' => $this->store_id,
            'label' => $this->label,
            'slug' => $this->slug,
            'price' => number_format($this->price, 0, ','),
            'stock' => $this->stock,
            'deskripsi' => $this->deskripsi,
            'created_at' => $this->created_at
        ];
    }
}
