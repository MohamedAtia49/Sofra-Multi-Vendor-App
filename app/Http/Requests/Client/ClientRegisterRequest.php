<?php

namespace App\Http\Requests\Client;

use App\Http\Requests\Base\ApiRequest;

class ClientRegisterRequest extends ApiRequest
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
            'email' => 'required|unique:clients|email',
            'phone' => 'required|unique:clients',
            'region_id' => 'required|exists:regions,id',
            'password' => 'required|confirmed',
        ];
    }
}
