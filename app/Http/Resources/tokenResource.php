<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class tokenResource extends JsonResource
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
            'token' => $this->id,
            'user_id' => $this->user_id
        ];
    }
}