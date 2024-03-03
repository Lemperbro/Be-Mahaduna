<?php

namespace App\Http\Requests\Artikel;

use Illuminate\Foundation\Http\FormRequest;

class ArtikelCreateRequest extends FormRequest
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
            'bannerImage' => 'required',
            'judul' => 'required',
            'kategori' => 'required',
            'isi' => 'required'
        ];
    }


    public function messages(): array
    {
        return [
            'bannerImage.required' => 'Gambar banner wajib diunggah.',
            'judul.required' => 'Judul wajib diisi.',
            'kategori.required' => 'Kategori wajib diisi.',
            'isi.required' => 'Isi wajib diisi.'
        ];
    }
}
