<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengirimanBuys extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "terima_buys";
    public function pemasok()
    {
        return $this->belongsTo(\App\Models\Kontak::class);
    }
}
