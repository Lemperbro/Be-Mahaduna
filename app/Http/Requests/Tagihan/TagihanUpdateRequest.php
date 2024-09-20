<?php

namespace App\Http\Requests\Tagihan;

use Illuminate\Foundation\Http\FormRequest;

class TagihanUpdateRequest extends FormRequest
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
            'label' => 'required|max:200',
            'price' => 'required|integer',
            'date' => 'required|date',
        ];
    }
    public function messages()
    {
        return [
            'label.required' => 'Kolom keterangan harus diisi.',
            'label.max' => 'Kolom keterangan maksimal :max karakter.',
            'price.required' => 'Kolom tagihan harus diisi.',
            'price.integer' => 'Kolom tagihan harus berupa angka.',
            'date.required' => 'Kolom bulan tagihan harus diisi.',
            'date.date' => 'Kolom bulan tagihan harus berupa tanggal yang valid.',
        ];
    }
}
