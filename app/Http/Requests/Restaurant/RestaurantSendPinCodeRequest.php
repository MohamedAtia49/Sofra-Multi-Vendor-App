<?php

namespace App\Http\Requests\Restaurant;

use App\Http\Requests\Base\ApiRequest;

class RestaurantSendPinCodeRequest extends ApiRequest
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
            'email' => 'required|exists:restaurants,email',
        ];
    }
}
