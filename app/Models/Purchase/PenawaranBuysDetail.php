<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenawaranBuysDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'penawaran_buy_details';

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id');
    }
}
