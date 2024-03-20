<?php

namespace App\Http\Requests\Api\Majalah;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MajalahAllRequest extends FormRequest
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
            'paginate' => 'min:1|numeric',
            'keyword' => 'string',
            'sortBest' => 'boolean',
        ];
    }
    public function messages(): array
    {
        return [
            'paginate.min' => 'Paginate halaman harus minimal :min.',
            'paginate.numeric' => 'Paginate halaman harus berupa angka.',
            'keyword.string' => 'Keyword harus berupa teks.',
            'sortBest.boolean' => 'Parameter sortBest harus berupa nilai boolean (true = 1 /false = 0).',
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
