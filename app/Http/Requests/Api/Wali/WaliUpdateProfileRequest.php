<?php

namespace App\Http\Requests\Api\Wali;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class WaliUpdateProfileRequest extends FormRequest
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
        $wali_id = auth()->user()->wali_id;
        return [
            'nama' => 'required|string',
            'email' => 'required|email|unique:wali,email,' . $wali_id . ',wali_id',
            'alamat' => 'required',
            'telp' => 'required|numeric|unique:wali,telp,' . $wali_id . ',wali_id',
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed'
            ]
        ];
    }
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama harus diisi.',
            'nama.string' => 'Nama harus berupa teks.',

            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',

            'alamat.required' => 'Alamat harus diisi.',

            'desa.required' => 'Desa harus diisi.',

            'telp.required' => 'Nomor telepon harus diisi.',
            'telp.numeric' => 'Nomor telepon harus berupa angka.',
            'telp.unique' => 'Nomor telepon sudah digunakan.',

            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.'
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            'error' => true,
            'code' => 400,
            'message' => $validator->getMessageBag()
        ], 400));
    }

}
