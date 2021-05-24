<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class NewPatientRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:patients|email',
            'phone' => 'required',
            'ktp' => 'required|image|max:256',
            'kk' => 'required|image|max:256'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama Wajib Diisi',
            'email.required' => 'Email Wajib Diisi',
            'email.unique' => 'Email Telah Digunakan',
            'phone.required' => 'Nomer Telfon Wajib Diisi',
            'ktp.required' => 'Scan KTP Wajib Diisi',
            'kk.required' => 'Scan Kartu Keluarga Wajib Diisi',
            'ktp.image' => 'Scan KTP Harus Berupa File Gambar',
            'kk.image' => 'Scan Kartu Keluarga Harus Berupa File Gambar',
            'ktp.max' => 'Ukuran Maksimal 256KB',
            'kk.max' => 'Ukuran Maksimal 256KB'
        ];
    }
}
