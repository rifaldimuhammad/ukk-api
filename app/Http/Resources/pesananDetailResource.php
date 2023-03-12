<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class pesananDetailResource extends JsonResource
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
            'id_pesanan' => $this->id_pesanan,
            'jumlah_pesanan' => $this->jumlah_pesanan,
            'sub_total' => $this->sub_total,
            'id_menu' => $this->id_menu,
            'nama_menu' => $this->menu->nama,
            'harga_menu' => $this->menu->harga,
        ];
    }
}
