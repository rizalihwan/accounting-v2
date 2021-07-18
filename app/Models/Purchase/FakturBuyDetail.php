<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FakturBuyDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function faktur()
    {
        return $this->belongsTo(FakturBuy::class, 'faktur_id');
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }
}
