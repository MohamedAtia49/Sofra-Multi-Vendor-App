<?php

namespace App\Http\Requests\Client;

use App\Http\Requests\Base\ApiRequest;

class ClientResetPasswordRequest extends ApiRequest
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
            'pin_code' => 'required',
            'password' => 'required|confirmed',
        ];
    }
}
