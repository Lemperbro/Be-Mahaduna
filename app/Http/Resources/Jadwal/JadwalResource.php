<?php

namespace App\Http\Resources\Jadwal;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JadwalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'jadwal_id' => $this->jadwal_id,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'jadwal' => $this->jadwal,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
