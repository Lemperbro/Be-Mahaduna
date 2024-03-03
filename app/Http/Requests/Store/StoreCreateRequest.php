<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class StoreCreateRequest extends FormRequest
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
            'image' => 'required',
            'label' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'deskripsi' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'image.required' => 'Gambar wajib diunggah.',
            'label.required' => 'Label wajib diisi.',
            'price.required' => 'Harga wajib diisi.',
            'price.integer' => 'Harga harus berupa angka.',
            'stock.required' => 'Stok wajib diisi.',
            'stock.integer' => 'Stok harus berupa angka.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
        ];
    }

}
