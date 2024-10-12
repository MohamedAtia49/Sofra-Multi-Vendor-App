<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'meal' =>[
                'name' =>$this->meal_name,
                'desc' => $this->meal_description,
                'image' => $this->meal_image,
            ],
            'date' =>[
                'from' => $this->date_from,
                'to' => $this->date_to,
            ],
            'restaurant_name' => $this->restaurant->name,
        ];
    }
}
