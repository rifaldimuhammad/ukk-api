<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class aktifitasResource extends JsonResource
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
            'id_user' => $this->id_user,
            'nama_aktifitas' => $this->nama_aktifitas,
            'read' => $this->read,
            'nama_user' => $this->user->name,
            'cover_user' => $this->user->cover,
            'level_user' => $this->user->level,
        ];
    }
}
