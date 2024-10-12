<?php

namespace App\Http\Requests\Client;

use App\Http\Requests\Base\ApiRequest;

class ClientContactsRequest extends ApiRequest
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
            'email' => 'required|exists:clients,email',
            'phone' => 'required',
            'message_type' => 'required',
            'message' => 'required',
        ];
    }
}
