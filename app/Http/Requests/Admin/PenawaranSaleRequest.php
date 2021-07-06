<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PenawaranSaleRequest extends FormRequest
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
            'tanggal' => 'required|date|date_format:Y-m-d',
            'penawarans.*.product_id' => 'required|exists:products,id',
            'penawarans.*.jumlah' => 'required|numeric',
            'penawarans.*.satuan' => 'required',
            'penawarans.*.harga' => 'required|numeric',
            'penawarans.*.total' => 'required|numeric',
            'total' => 'required',
        ];
    }
}
