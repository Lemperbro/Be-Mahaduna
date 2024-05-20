<?php

namespace App\Http\Requests\ManageAdmin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'image' => 'image|mimes:png,jpg,jpeg|max:2048',
            'username' => 'string',
            'email' => 'email',
            'telp' => 'numeric'
        ];
    }


    public function messages(): array
    {
        return [
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Gambar harus berformat: png, jpg, jpeg.',
            'image.max' => 'Ukuran gambar maksimal adalah 2MB.',
            'username.string' => 'Username harus berupa teks.',
            'email.email' => 'Format email tidak valid.',
            'telp.numeric' => 'Nomor telepon harus berupa angka.'
        ];
    }

}
