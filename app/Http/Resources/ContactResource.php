<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
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
            'type' => 'contact',
            'id' => (string) $this->id,
            'attributes' => [
                'contact_type' => $this->contact_type,
                'contact' => $this->contact,
                'description' => $this->description,
                'verified_ad' => $this->verified_at,
                'isLocalPSTNPhone' => $this->isLocalPhone,
                'isMobilePhone' => $this->isMobilePhone,
                'phoneFormat_RFC' => $this->phoneFormat_RFC,
                'phoneFormat_National' => $this->phoneFormat_National,
                'phoneFormat_Local' => $this->phoneFormat_Local,
                'phoneCarrier' => $this->phoneCarrier,
                'created_at' =>$this->created_at,
                'updated_at' =>$this->updated_at,
            ],
        ];
    }
}
