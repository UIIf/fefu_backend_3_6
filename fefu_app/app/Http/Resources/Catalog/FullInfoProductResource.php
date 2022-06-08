<?php

namespace App\Http\Resources\Catalog;

use Illuminate\Http\Resources\Json\JsonResource;
/**
 * @mixin Product
 */
class FullInfoProductResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'price' => $this->price,
            'description' => $this->description,

            'category' => new CategoryResource(
                $this->productCategory
            ),

            'attributes' => AttributeValueResource::collection(
                $this->sortedAttributeValues
            )
        ];
    }
}