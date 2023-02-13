<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class invoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'id_menu' => $this->id_menu,
            'id_pesanan' => $this->id_pesanan,
            'jumlah_pesanan' => $this->jumlah_pesanan,
            'total_harga' => $this->total_harga,
            'created_at' => $this->created_at->format('d F Y'),
            'created_at_time' => $this->created_at->format('h:i:s'),
        ];
    }
}
