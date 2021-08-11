<?php

namespace App\Models\Sale;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenawaranSaleDetail extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $columns = [
        'id', 'penawaran_id', 'product_id', 'satuan', 'harga', 'jumlah',
        'total', 'created_at', 'updated_at'
    ];

    public function scopeExclude($query, $value = [])
    {
        return $query->select(array_diff($this->columns, (array) $value));
    }

    public function penawaran()
    {
        return $this->belongsTo(PenawaranSale::class, 'penawaran_id');
    }

    public function product()
    {
        return $this->belongsTo('\App\Models\Product', 'product_id');
    }
}
