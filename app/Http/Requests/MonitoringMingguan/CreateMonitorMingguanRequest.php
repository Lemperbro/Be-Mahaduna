<?php

namespace App\Http\Requests\MonitoringMingguan;

use Illuminate\Foundation\Http\FormRequest;

class CreateMonitorMingguanRequest extends FormRequest
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
            'tidak_hadir' => 'required|numeric',
            'terlambat' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'santri.required' => 'Kolom santri wajib diisi.',
            'santri.numeric' => 'Kolom santri harus berupa angka.',
            'tidak_hadir.required' => 'Kolom tidak hadir wajib diisi.',
            'tidak_hadir.numeric' => 'Kolom tidak hadir harus berupa angka.',
            'terlambat.required' => 'Kolom terlambat wajib diisi.',
            'terlambat.numeric' => 'Kolom terlambat harus berupa angka.'
        ];
    }
    
}
