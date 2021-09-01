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
            'nama'          => 'required',
            'email'         => 'nullable|email',
            'telepon'       => 'nullable|numeric',
            'alamat'        => 'nullable',
            'kota'          => 'nullable',
            'kode_pos'      => 'nullable|numeric',
            'kode_kontak'   => 'nullable',
            'mata_uang'     => 'nullable',
            'nik'           => 'nullable|numeric',
            'kontak_person' => 'nullable',
            'website'       => 'nullable',
            'pelanggan'     => 'required_without_all:pemasok,karyawan,nasabah,petugas',
            'pemasok'       => 'required_without_all:pelanggan,karyawan,nasabah,petugas',
            'karyawan'      => 'required_without_all:pelanggan,pemasok,nasabah,petugas',
            'nasabah'       => 'required_without_all:pelanggan,pemasok,karyawan,petugas',
            'petugas'       => 'required_without_all:pelanggan,pemasok,karyawan,nasabah',
        ];
    }
}
