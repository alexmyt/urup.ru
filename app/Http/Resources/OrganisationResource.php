<?php

namespace App\Http\Resources;

use App\Category;
use App\Address;
use App\Contact;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganisationResource extends JsonResource
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
            'type' => 'organisations',
            'id' => (string) $this->id,
            'attributes' => [
                'name' => (string) $this->name,
                'fullName' =>(string) $this->fullName,
                'description' =>(string) $this->description,
                'slug' => $this->slug,
                //'contacts' => ContactResource::collection($this->whenLoaded('contacts')),
                //'categories' => CategoryResource::collection($this->whenLoaded('categories')),
                //'categories' => $this->whenLoaded('categories'),
                //'addresses' => ContactResource::collection($this->whenLoaded('addresses')),
            ],
            'relationships' => new OrganisationRelationshipResource($this),
            'links' => [
                'self' => action('Api\OrganisationController@show',['organisation' => $this->id]),
            ],
        ];
    }

    public function with($request){

        $includes = $this->whenLoaded('categories')->values();
        $includes = $includes->merge($this->whenLoaded('contacts')->values());
        $includes = $includes->merge($this->whenLoaded('addresses')->values());

        return [
            'included' => $includes->map(
                function ($include) {
                    if ($include instanceof Category){
                        return new CategoryResource($include);
                    }

                    if ($include instanceof Contact){
                        return new ContactResource($include);
                    }

                    if ($include instanceof Address){
                        return new AddressResource($include);
                    }
                }),
        ];
    }
}
