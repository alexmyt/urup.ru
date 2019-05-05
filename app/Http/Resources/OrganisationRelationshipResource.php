<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrganisationRelationshipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return[
            'categories' => [ 
                'data' => CategoryIdentifierResource::collection($this->whenLoaded('categories')),
            ],
            'addresses' => [ 
                'data' => AddressIdentifierResource::collection($this->whenLoaded('addresses')),
            ],
            'contacts' => [ 
                'data' => ContactIdentifierResource::collection($this->whenLoaded('contacts')),
            ],
        ];
    }
}
