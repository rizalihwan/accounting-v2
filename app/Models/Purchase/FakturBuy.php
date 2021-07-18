<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FakturBuy extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function faktur_details()
    {
        return $this->hasMany(FakturBuyDetail::class, 'faktur_id');
    }

    public function pemasok()
    {
        return $this->belongsTo(\App\Models\Kontak::class);
    }

    public function pesanan()
    {
        return $this->belongsTo(PesananBuys::class);
    }

    public function akun()
    {
        return $this->belongsTo(\App\Models\Akun::class);
    }
}
