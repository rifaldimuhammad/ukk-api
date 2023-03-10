<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class menuResource extends JsonResource
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
            'nama' => $this->nama,
            'deskripsi' => $this->deskripsi,
            'kategori' => $this->kategori,
            'harga' => $this->harga,
            'cover' => $this->cover
        ];
    }
}
