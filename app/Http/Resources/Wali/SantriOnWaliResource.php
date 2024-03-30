<?php

namespace App\Http\Resources\Wali;

use App\Http\Resources\Santri\SantriOnRelasiResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SantriOnWaliResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'wali_id' => $this->wali_id,
            'santri' => SantriOnRelasiResource::collection($this->whenLoaded('waliRelasi'))
        ];
    }
}
