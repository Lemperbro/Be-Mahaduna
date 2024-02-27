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
            'channelId' => $this->channelId,
            'channelTitle' => $this->channelTitle,
            'title' => $this->title,
            'deskripsi' => $this->deskripsi,
            'thumbnail' => $this->thumbnail,
            'videoCount' => $this->videoCount,
            'embededHtml' => $this->embededHtml,
            'publishedAt' => $this->publishedAt
        ];
    }
}
