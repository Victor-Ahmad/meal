<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'price' => $this->price,
            'amount' => $this->amount,
            'category_id' => $this->category_id,
            'sub_category_id' => $this->sub_category_id,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'sub_category' => new SubCategoryResource($this->whenLoaded('sub_category')),
            'offers' => $this->whenLoaded('offers', function () {
                return $this->offers->map(function ($offer) {
                    return [
                        'id' => $offer->id,
                        'offer_price' => $offer->offer_price,
                        'amount' => $offer->amount,
                    ];
                });
            }),
        ];
    }
}
