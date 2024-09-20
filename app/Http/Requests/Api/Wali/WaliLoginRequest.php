<?php

namespace App\Http\Requests\Api\Wali;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class WaliLoginRequest extends FormRequest
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
            'emailOrTelp' => 'required|string|email_or_numeric',
            'password' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'emailOrTelp.required' => 'Email atau nomor telepon harus diisi.',
            'emailOrTelp.string' => 'Email atau nomor telepon harus dalam format teks.',
            'emailOrTelp.email_or_numeric' => 'Email atau nomor telepon harus berupa alamat email atau numerik (nomor telepon).',
            'password.required' => 'Kata sandi harus diisi.',
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
