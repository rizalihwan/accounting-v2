<?php

namespace App\Models\Sale;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananSale extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pesanan_details()
    {
        return $this->hasMany(PesananSaleDetail::class, 'pesanan_id');
    }

    public function pelanggan()
    {
        return $this->belongsTo(\App\Models\Kontak::class);
    }

    public function penawaran()
    {
        return $this->belongsTo(PenawaranSale::class, 'penawaran_id');
    }

    public function pengiriman()
    {
        return $this->hasMany(PengirimanSale::class, 'pesanan_id');
    }
}
