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
            'playlistId' => 'required|string',
            'part' => 'string',
            'paginate' => 'integer|min:1',
            'pageToken' => 'string'
        ];
    }

    public function messages()
    {
        return [
            'playlistId.required' => 'playlistId harus dimasukan',
            'playlistId.string' => 'playlistId harus string',
            'part.string' => 'part harus string',
            'paginate.integer' => 'paginate harus integer',
            'paginate.min' => 'paginate minimal 1',
            'pageToken.string' => 'nextPageToken harus string'
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
