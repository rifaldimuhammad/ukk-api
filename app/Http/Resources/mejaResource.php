<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class mejaResource extends JsonResource
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
            'option' => $this->option,
            'status' => $this->status,
            'no_meja' => $this->no_meja,
        ];
    }
}
