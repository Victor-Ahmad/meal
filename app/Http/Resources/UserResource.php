<?php

namespace App\Http\Resources;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        $addresses = Address::where('user_id', $this->id)->get();
        return [
            'id' => $this->id,
            'name' => $this->name ?? '',
            'phone' => $this->phone_number ?? '',
            'email' => $this->email ?? '',
            'address' => AddressResource::collection($addresses),
        ];
    }
}
