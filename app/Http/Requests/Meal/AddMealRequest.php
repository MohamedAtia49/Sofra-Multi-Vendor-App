<?php

namespace App\Http\Requests\Meal;

use App\Http\Requests\Base\ApiRequest;

class AddMealRequest extends ApiRequest
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
            'name' => 'required|unique:meals,name',
            'description' => 'required',
            'price' => 'required',
            'offer_price' => 'required',
            'processing_time' => 'required',
            'restaurant_id' => 'exists:restaurants,id',
        ];
    }
}
