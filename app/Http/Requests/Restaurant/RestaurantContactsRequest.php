<?php

namespace App\Http\Requests\Restaurant;

use App\Http\Requests\Base\ApiRequest;

class RestaurantContactsRequest extends ApiRequest
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
            'name' => 'required',
            'email' => 'required|exists:restaurants,email',
            'phone' => 'required',
            'message_type' => 'required',
            'message' => 'required',
        ];
    }
}
