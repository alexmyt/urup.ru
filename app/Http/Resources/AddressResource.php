<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'address',
            'id' => (string) $this->id,
            'attributes' => [
                'address' => $this->address,
                'lat' => $this->lat,
                'lon' => $this->lon,
                'locality' => $this->locality,
                'description' => $this->description,
                'created_at' =>$this->created_at,
                'updated_at' =>$this->updated_at,
            ],
        ];
    }
}
