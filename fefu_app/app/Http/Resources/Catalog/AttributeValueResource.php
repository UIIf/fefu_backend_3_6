<?php

namespace App\Http\Resources\Catalog;
use App\Models\News;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin ProductAttributeValues
 */
class AttributeValueResource extends JsonResource
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
            'name' => $this->name,
            'value' => $this->value,
        ];
    }
}