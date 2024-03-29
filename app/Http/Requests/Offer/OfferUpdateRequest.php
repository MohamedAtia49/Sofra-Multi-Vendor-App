<?php

namespace App\Http\Requests\Offer;

use App\Http\Requests\Base\ApiRequest;
class OfferUpdateRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:offers,id',
            'meal_name' => 'required',
            'meal_description' => 'required',
            'meal_image' => 'required',
            'date_from' => 'required|date',
            'date_to' => 'required|date',
            'restaurant_id' => 'exists:restaurants,id',
        ];
    }
}
