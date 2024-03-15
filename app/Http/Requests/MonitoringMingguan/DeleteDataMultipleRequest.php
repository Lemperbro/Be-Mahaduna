<?php

namespace App\Http\Requests\MonitoringMingguan;

use Illuminate\Foundation\Http\FormRequest;

class DeleteDataMultipleRequest extends FormRequest
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
            'monitor_mingguan_id_delete_multiple' => 'required'
        ];
    }
    public function messages(){
        return [
            'monitor_mingguan_id_delete_multiple' => 'Pilih salah satu data tagihan untuk dihapus'
        ];
    }
}
