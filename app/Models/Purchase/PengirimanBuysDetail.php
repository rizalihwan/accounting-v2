<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengirimanBuysDetail extends Model
{
    use HasFactory;

    protected $table = "terima_buy_details";
    protected $guarded = [];

    public function penerimaan()
    {
        return $this->belongsTo(PengirimanBuys::class, 'terima_id');
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }
}
