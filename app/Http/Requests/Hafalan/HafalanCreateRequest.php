<?php

namespace App\Http\Requests\Hafalan;

use Illuminate\Foundation\Http\FormRequest;

class HafalanCreateRequest extends FormRequest
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
            'santri' => 'required|numeric',
            'progres' => 'required|string',
            'bulan' => 'required|date'
        ];
    }
    public function messages(): array
    {
        return [
            'santri.required' => 'Kolom santri harus diisi.',
            'santri.numeric' => 'Kolom santri harus berupa angka.',
            'progres.required' => 'Kolom progres harus diisi.',
            'progres.string' => 'Kolom progres harus berupa teks.',
            'bulan.required' => 'Kolom bulan harus diisi.',
            'bulan.date' => 'Kolom bulan harus dalam format tanggal yang benar.'
        ];
    }
}
