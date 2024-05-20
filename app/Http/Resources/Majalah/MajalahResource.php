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
            'majalah_id' => $this->majalah_id,
            'judul' => $this->judul,
            'bannerImage' => url('/') . '/' . $this->bannerImage,
            'source' => url('/') . '/' . $this->source,
            'views' => $this->views,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
