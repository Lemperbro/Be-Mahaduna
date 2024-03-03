<?php

namespace App\Http\Resources\Majalah;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MajalahResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'judul' => $this->judul,
            'bannerImage' => $this->bannerImage,
            'source' => $this->source,
            'views' => $this->views,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
