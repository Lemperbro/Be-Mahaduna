<?php

namespace App\Http\Requests\Youtube;

use App\Models\PlaylistVideo;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreatePlaylistIdRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
        // return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'playlistId.*' => [
                'required',
                Rule::unique('playlist_video', 'playlistId')->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'playlistId.*.required' => 'Kolom Playlist ID harus diisi.',
            'playlistId.*.unique' => 'Playlist ID sudah tersimpan. Pilih Playlist ID lain.'
        ];
    }

    // protected function failedValidation(Validator $validator){
    //     throw new HttpResponseException(response([
    //         'error' => $validator->getMessageBag()
    //     ], 400));
    // }
}
