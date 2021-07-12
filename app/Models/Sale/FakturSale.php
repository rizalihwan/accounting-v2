<?php

namespace App\Models\Sale;

use App\Models\Akun;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FakturSale extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function faktur_details()
    {
        return $this->hasMany(FakturSaleDetail::class, 'faktur_id');
    }

    public function pelanggan()
    {
        return $this->belongsTo(\App\Models\Kontak::class);
    }

    public function pesanan()
    {
        return $this->belongsTo(PesananSale::class, 'pesanan_id');
    }

    public function akun()
    {
        return $this->belongsTo(Akun::class, 'akun_id');
    }
}
