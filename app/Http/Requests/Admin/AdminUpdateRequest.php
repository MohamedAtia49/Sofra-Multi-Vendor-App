<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminUpdateRequest extends FormRequest
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
            'name' => ['required', Rule::unique('users')->ignore($this->user)],
            'email' => ['required','email',Rule::unique('users')->ignore($this->user)],
            'password' => 'required|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ];
    }
}
