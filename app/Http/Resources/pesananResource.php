<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class pesananResource extends JsonResource
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
            'nama_menu' => $this->menus->nama,
            'id_pesanan' => $this->id_pesanan,
            'jumlah_pesanan' => $this->jumlah_pesanan,
            'total_harga' => $this->total_harga,
            'tunai' => $this->tunai,
            'no_meja' => $this->no_meja,
            'waktu' => $this->waktu,
            'ekstra_waktu' => $this->ekstra_waktu,
            'timesTamps' => $this->created_at->format('y-m-d h:i:s'),
            'created_at' => $this->created_at->format('F d , Y'),
            'created_at_time' => $this->created_at->format('H:i:s'),
            'updated_at' => $this->updated_at->format('F d , Y'),
            'updated_at_time' => $this->updated_at->format('H:i:s'),
        ];
    }
}
