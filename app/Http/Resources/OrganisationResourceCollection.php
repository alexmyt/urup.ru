<?php

namespace App\Http\Resources;

use App\Category;
use App\Address;
use App\Contact;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrganisationResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'data' => OrganisationResource::collection($this->collection),
        ];
    }

    public function with($request)
    {
        $categories = $this->collection->flatMap(
            function ($organisation){
                return $organisation->relationLoaded('categories') ? $organisation->categories : '';
            }
        );

        $contacts = $this->collection->flatMap(
            function ($organisation){
                return $organisation->relationLoaded('contacts') ? $organisation->contacts : '';
            }
        );

        $addresses = $this->collection->flatMap(
            function ($organisation){
                return $organisation->relationLoaded('addresses') ? $organisation->addresses : '';
            }
        );

        $includes = $categories->unique('id')->values();
        $includes = $includes->merge($contacts->unique('id')->values());
        $includes = $includes->merge($addresses->unique('id')->values());

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
