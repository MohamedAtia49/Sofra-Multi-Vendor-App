<?php

namespace App\Http\Requests\Restaurant;

use App\Http\Requests\Base\ApiRequest;
class RestaurantRegisterRequest extends ApiRequest
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
            'name' => 'required',
            'email' => 'required|unique:restaurants|email',
            'phone' => 'required|unique:restaurants',
            'password' => 'required|confirmed',
            'minimum_charge' => 'required',
            'delivery_cost' => 'required',
            'image' => 'file|image|mimes:jpeg,jpg,png',
            'whats_up' => 'required|unique:restaurants',
            'categories' => 'array',
            'categories.*' => 'required|exists:categories,id',
            'region_id' => 'required|exists:regions,id',
        ];
    }
}
