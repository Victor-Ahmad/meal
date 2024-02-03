<?php

namespace App\Http\Resources;

use App\Models\OfferImage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        $images = OfferImage::where('offer_id', $this->id)->pluck('image')->toArray();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image ?? '',
            // 'offer_price' => $this->offer_price,
            // 'amount' => $this->amount,
            // 'product_id' => $this->product_id,
            // 'product' => new ProductResource($this->whenLoaded('product')),
        ];
    }
}
