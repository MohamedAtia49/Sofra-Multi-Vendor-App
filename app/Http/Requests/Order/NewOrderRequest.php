<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\Base\ApiRequest;

class NewOrderRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'restaurant_id' => 'required|exists:restaurants,id',
            'meals.*.meal_id' => 'required|exists:meals,id',
            'meals.*.quantity' => 'required',
            'address' => 'required',
            'payment_method' => 'required',
        ];
    }
}
