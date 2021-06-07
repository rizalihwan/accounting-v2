<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class KontakRequest extends FormRequest
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
            'nama' => 'required',
            'email' => 'required',
            'telepon' => 'nullable',
            'pelanggan' => 'required|boolean',
            'pemasok' => 'required|boolean',
            'karyawan' => 'required|boolean',
            'alamat' => 'nullable',
            'kota' => 'nullable',
            'kode_pos' => 'nullable',
            'kode_kontak' => 'nullable',
            'mata_uang' => 'nullable',
            'nik' => 'nullable',
            'kontak_person' => 'nullable',
            'website' => 'nullable',
            'aktif' => 'required|boolean',
        ];
    }
}
