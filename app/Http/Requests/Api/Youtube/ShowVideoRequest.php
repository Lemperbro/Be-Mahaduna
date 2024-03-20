<?php

namespace App\Http\Requests\Api\Youtube;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ShowVideoRequest extends FormRequest
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
            'part' => 'string',
            'videoId' => 'string'
        ];
    }
    public function messages()
    {
        return [
            'part.string' => 'part harus berupa string!',
            'videoId.string' => 'videoId harus berupa string!'
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            'error' => true,
            'code' => 400,
            'message' => $validator->getMessageBag()
        ], 400));
    }
}
