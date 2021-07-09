<?php

namespace App\Models\Sale;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengirimanSale extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pengiriman_details()
    {
        return $this->hasMany(PengirimanSaleDetail::class, 'pengiriman_id');
    }

    public function pelanggan()
    {
        return $this->belongsTo(\App\Models\Kontak::class);
    }

    public function pesanan()
    {
        return $this->belongsTo(PesananSale::class, 'pesanan_id');
    }
}
