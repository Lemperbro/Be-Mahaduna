<?php

namespace App\Http\Resources\Tagihan;

use App\Http\Resources\Santri\SantriResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TagihanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'tagihan_id' => $this->tagihan_id,
            'santri_id' => $this->santri_id,
            'santri' => SantriResource::make($this->whenLoaded('santri')),
            'transaksi' => $this->whenLoaded('transaksi'),
            'label' => $this->label,
            'price' => $this->price,
            'date' => $this->date,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
