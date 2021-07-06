<?php

namespace App\Models\Sale;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenawaranSaleDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function penawaran()
    {
        return $this->belongsTo(PenawaranSale::class, 'penawaran_id');
    }
}
