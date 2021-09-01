<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengirimanBuys extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "terima_buys";

    public function pengiriman_details()
    {
        return $this->hasMany(PengirimanBuysDetail::class, 'terima_id');
    }

    public function pemasok()
    {
        return $this->belongsTo(\App\Models\Kontak::class);
    }

    public function pesanan()
    {
        return $this->belongsTo(PesananBuys::class, 'pesanan_id');
    }
}
