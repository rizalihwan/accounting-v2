<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FakturSaleRequest extends FormRequest
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
            'pelanggan_id' => 'required|exists:kontaks,id',
            'pesanan_id' => 'exists:pesanan_sales,id',
            'tanggal' => 'required|date|date_format:Y-m-d',
            'total' => 'required',
        ];
    }
}
