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
            'cover_menu' => $this->menu->cover,
            'harga_menu' => $this->harga_menu,
            'nama_menu' => $this->menu->nama,
            'total_harga' => $this->total_harga,
            'jumlah_menu' => $this->jumlah_menu,
        ];
    }
}
