<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryIdentifierResource extends JsonResource
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
        return [
            'type' => 'category',
            'id' => (string) $this->id,
        ];
    }

    public function with($request){
        return [
            // 'links' => [
            //    'self' => action('Api\CategoryController@show',$this->id),
            // ],
        ];
    }
}
