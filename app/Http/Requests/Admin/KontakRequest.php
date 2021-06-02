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
            'kode' => 'required',
            'nama' => 'required',
            'kategori_id' => 'required',
            'alamat' => 'nullable',
            'kota' => 'nullable',
            'kode_pos' => 'nullable',
            'telepon' => 'nullable',
            'fax' => 'nullable',
            'bank' => 'nullable',
            'ac' => 'nullable',
            'catatan' => 'nullable'
        ];
    }
}
