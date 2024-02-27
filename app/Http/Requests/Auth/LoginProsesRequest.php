<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginProsesRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|min:8'
        ];
    }
    public function messages(): array
{
    return [
        'email.required' => 'Kolom email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'password.required' => 'Kolom password wajib diisi.',
        'password.min' => 'Panjang minimal password adalah :min karakter.'
    ];
}
}
