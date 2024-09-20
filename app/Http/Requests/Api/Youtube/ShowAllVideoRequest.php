<?php

namespace App\Http\Requests\Api\Youtube;

use Illuminate\Foundation\Http\FormRequest;

class ShowAllVideoRequest extends FormRequest
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
            'evenType' => 'string|in:completed,live',
            'paginate' => 'numeric|min:1',
            'pageToken' => 'string'
        ];
    }
    
    public function messages()
    {
        return [
            'evenType.in' => 'evenType harus sama dengan "completed" atau "live".',
            'paginate.numeric' => 'paginate harus berupa angka.',
            'paginate.min' => 'paginate harus lebih besar dari 0.',
            'pageToken.string' => 'pageToken harus string'
        ];
    }
}
