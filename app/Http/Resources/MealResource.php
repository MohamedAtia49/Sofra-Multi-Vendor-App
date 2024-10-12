<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'desc' => $this->desc,
            'price' => $this->price,
            'offer_price' => $this->offer_price,
            'processing_time' => $this->processing_time,
            'restaurant name' => $this->restaurant->name,
        ];
    }
}
