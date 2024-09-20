<?php

namespace App\Http\Resources\Transaksi;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransaksiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'transaksi_id' => $this->transaksi_id,
            'tagihan_id' => $this->tagihan_id,
            'invoice_id' => $this->invoice_id,
            'external_id' => $this->external_id,
            'payment_link' => $this->payment_link,
            'price' => $this->price,
            'pay' => $this->pay,
            'payment_type' => $this->payment_type,
            'payment_status' => $this->payment_status,
            'expired' => $this->expired,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
