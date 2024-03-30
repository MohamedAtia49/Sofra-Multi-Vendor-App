<?php

namespace App\Http\Requests\Client;

use App\Http\Requests\Base\ApiRequest;

class ClientAddReviewRequest extends ApiRequest
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
            'star_rating' => 'required',
            'comments' => 'required',
            'client_id' => 'exists:clients,id',
            'restaurant_id' => 'required|exists:restaurants,id',
        ];
    }
}
