<?php

namespace App\Http\Requests\Wali;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WaliCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string',
            'desa' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('wali', 'email')
                    ->whereNull('deleted_at')
            ],
            'alamat' => 'required',
            'telp' => [
                'required',
                'numeric',
                Rule::unique('wali', 'telp')
                    ->whereNull('deleted_at')
            ],
        ];
    }
    public function messages()
    {
        return [
            'nama.required' => 'Kolom nama wajib diisi.',
            'email.required' => 'Kolom email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'alamat.required' => 'Kolom alamat wajib diisi.',
            'telp.required' => 'Kolom telepon wajib diisi.',
            'telp.numeric' => 'Kolom telepon harus berupa angka.',
            'telp.unique' => 'Nomor Telphone Sudah Terdaftar'
        ];
    }
}
