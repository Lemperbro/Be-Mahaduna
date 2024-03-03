<?php

namespace App\Http\Resources\Youtube;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaylistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'playlistId' => $this->playlistId,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
