<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananBuys extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pemasok()
    {
        return $this->belongsTo(\App\Models\Kontak::class);
    }

    public function penawaran()
    {
        return $this->belongsTo(PenawaranBuys::class, 'penawaran_id');
    }

    public function pesanan_details()
    {
        return $this->hasMany(PesananBuysDetail::class, 'pesanan_id');
    }
}
