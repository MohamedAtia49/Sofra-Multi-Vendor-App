<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'star ratings' => $this->star_rating,
            'comments' => $this->comments,
            'client name' => $this->client->name,
            'restaurant name' => $this->restaurant->name,
        ];
    }
}
