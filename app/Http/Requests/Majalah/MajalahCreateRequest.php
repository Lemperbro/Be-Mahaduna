<?php

namespace App\Http\Requests\Majalah;

use Illuminate\Foundation\Http\FormRequest;

class MajalahCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return $this->user() !== null;
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
            'judul' => 'required',
            'bannerImage' => 'required',
            'majalahFile' => 'required|file|mimes:pdf',
        ];
    }


    public function messages()
    {
        return [
            'judul.required' => 'Kolom judul wajib diisi.',
            'bannerImage.required' => 'Kolom gambar banner wajib diisi.',
            'majalahFile.required' => 'Kolom file majalah wajib diisi.',
            'majalahFile.file' => 'Kolom file majalah harus berupa file.',
            'majalahFile.mimes' => 'Format file majalah tidak valid. Hanya mendukung format PDF.',
        ];
    }

}
