<?php

namespace App\Models\Sale;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananSaleDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pesanan()
    {
        $this->belongsTo(PesananSale::class, 'pesanan_id');
    }
}
