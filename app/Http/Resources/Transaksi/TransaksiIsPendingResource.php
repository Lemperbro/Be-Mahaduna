<?php

namespace App\Http\Resources\Transaksi;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransaksiIsPendingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'isPending' => true,
            'transaksi_id' => $this->transaksi_id,
            'tagihan_id' => $this->tagihan_id,
            'payment_status' => $this->payment_status
        ];
    }
}
