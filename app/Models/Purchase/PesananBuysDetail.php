<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananBuysDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = "pesanan_buy_detail";

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }
}
