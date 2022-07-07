<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GaleriResource extends JsonResource
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
            'foto' => $this->image,
            'judul' => $this->judul,
            'tanggal_kegiatan' => $this->tanggal_kegiatan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
