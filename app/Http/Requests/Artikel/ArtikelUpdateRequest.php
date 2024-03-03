<?php

namespace App\Http\Requests\Artikel;

use Illuminate\Foundation\Http\FormRequest;

class ArtikelUpdateRequest extends FormRequest
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
            'judul' => 'required',
            'kategori' => 'required',
            'isi' => 'required'
        ];
    }


    public function messages(): array
    {
        return [
            'judul.required' => 'Judul wajib diisi.',
            'kategori.required' => 'Kategori wajib diisi.',
            'isi.required' => 'Isi wajib diisi.'
        ];
    }
}
