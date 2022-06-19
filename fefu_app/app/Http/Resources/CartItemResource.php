<?php

namespace App\Http\Resources;

use App\Http\Resources\Catalog\FullInfoProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin CartItem
 */
class CartItemResource extends JsonResource
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
            'product' => FullInfoProductResource::make($this->product),
            'quantity' => $this->quantity,
            'price_item' => $this->price_item,
            'price_total' => $this->price_total,
        ];
    }
}