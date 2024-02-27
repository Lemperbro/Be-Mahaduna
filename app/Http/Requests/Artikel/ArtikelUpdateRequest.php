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
            'bannerImage' => 'image|mimes:png,jpg,jpeg|max:1024',
            'judul' => 'required',
            'kategori' => 'required',
            'isi' => 'required'
        ];
    }


    public function messages(): array
    {
        return [
            'bannerImage.image' => 'File yang diunggah harus berupa gambar.',
            'bannerImage.mimes' => 'Format gambar harus berupa PNG, JPG, atau JPEG.',
            'bannerImage.max' => 'Ukuran gambar tidak boleh melebihi 1024 kilobita.',
            'judul.required' => 'Judul wajib diisi.',
            'kategori.required' => 'Kategori wajib diisi.',
            'isi.required' => 'Isi wajib diisi.'
        ];
    }
}
