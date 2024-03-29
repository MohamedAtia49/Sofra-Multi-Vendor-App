<?php

namespace App\Http\Requests\Base;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

abstract class ApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract public function authorize();

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    abstract public function rules();

    protected function failedValidation(Validator $validator){
        $errors = (new ValidationException($validator))->errors();

        if (!empty($errors)){
            $transformedErrors = [];
            foreach($errors as $filed => $message){
                $transformedErrors[] = [
                    $filed => $message[0],
                ];
            }
        }

        throw new HttpResponseException(
            response()->json(
            [
                'status' => Response::HTTP_NOT_FOUND,
                'error' => $transformedErrors,
            ],
            Response::HTTP_NOT_FOUND),
        );
    }
}
