<?php

namespace App\Http\Requests\Santri;

use Illuminate\Foundation\Http\FormRequest;

class SantriCreateRequest extends FormRequest
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
            'nama' => 'required|max:150|string',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'jenjang' => 'required|integer',
            'wali' => 'required|integer'
        ];
    }
    public function messages(): array
    {
        return [
            'nama.required' => 'Kolom nama harus diisi.',
            'nama.max' => 'Kolom nama tidak boleh lebih dari 150 karakter.',
            'nama.string' => 'Kolom nama harus berupa teks.',

            'tgl_lahir.required' => 'Kolom tanggal lahir harus diisi.',
            'tgl_lahir.date' => 'Kolom tanggal lahir harus berupa tanggal.',

            'jenis_kelamin.required' => 'Kolom jenis kelamin harus diisi.',
            'jenis_kelamin.in' => 'Kolom jenis kelamin harus berisi salah satu dari "laki-laki" atau "perempuan".',

            'jenjang.required' => 'Kolom kelas harus diisi.',
            'jenjang.integer' => 'Kolom kelas harus berupa bilangan bulat.',

            'wali.required' => 'Kolom wali harus diisi.',
            'wali.integer' => 'Kolom wali harus berupa bilangan bulat.'
        ];
    }
}
