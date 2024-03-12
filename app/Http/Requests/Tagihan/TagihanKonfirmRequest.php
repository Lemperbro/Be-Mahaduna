<?php

namespace App\Http\Requests\Tagihan;

use Illuminate\Foundation\Http\FormRequest;

class TagihanKonfirmRequest extends FormRequest
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
            'payment_type' => 'required|string'
        ];
    }
    public function messages()
    {
        return [
            'payment_type.required' => 'Jenis pembayaran harus diisi.',
            'payment_type.string' => 'Jenis pembayaran harus berupa teks.',
        ];
    }

}
