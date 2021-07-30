<?php

namespace App\Models\Sale;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenawaranSale extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function penawaran_details()
    {
        return $this->hasMany(PenawaranSaleDetail::class, 'penawaran_id');
    }

    public function pelanggan()
    {
        return $this->belongsTo(\App\Models\Kontak::class);
    }

    public function pesanans()
    {
        return $this->hasMany(PesananSale::class, 'penawaran_id');
    }
}
