<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'client' => [
                'name' => $this->name,
                'phone' => $this->phone,
                'address' => $this->address,
            ],
            'order' => [
                'note' => $this->note,
                'cost' => $this->cost,
                'delivery_cost' => $this->delivery_cost,
                'total_price' => $this->total_price,
                'commission' => $this->commission,
                'net' => $this->net,
            ],
            'meals' => MealResource::collection($this->whenLoaded('meals')),
            'state' => $this->state,
            'payment method' => $this->payment_method,
        ];
    }
}
