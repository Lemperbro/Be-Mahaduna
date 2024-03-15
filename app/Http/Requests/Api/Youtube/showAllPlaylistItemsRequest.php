<?php

namespace App\Http\Requests\Api\Youtube;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class showAllPlaylistItemsRequest extends FormRequest
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
            'paginate' => 'integer|min:1'
        ];
    }

    public function messages()
    {
        return [
            'part.string' => 'part harus string',
            'paginate.integer' => 'paginate harus integer',
            'paginate.min' => 'paginate minimal 1'
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
