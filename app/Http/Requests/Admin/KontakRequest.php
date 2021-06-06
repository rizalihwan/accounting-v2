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
            'telepon' => 'required',
            'pelanggan' => 'required|boolean',
            'pemasok' => 'required|boolean',
            'karyawan' => 'required|boolean',
            'nik' => 'numeric|min:16|max:16',
            'telepon' => 'numeric',
            'kode_pos' = 'numeric',
            'aktif' => 'required|boolean',
        ];
    }
}
