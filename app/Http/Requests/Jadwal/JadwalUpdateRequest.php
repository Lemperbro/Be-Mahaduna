<?php

namespace App\Http\Requests\Jadwal;

use Illuminate\Foundation\Http\FormRequest;

class JadwalUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !==  null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'startTime' => 'required',
            'endTime' => 'required',
            'keterangan' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'startTime.required' => 'Waktu mulai harus diisi.',
            'endTime.required' => 'Waktu selesai harus diisi.',
            'keterangan.required' => 'Keterangan harus diisi.'
        ];
    }
}
