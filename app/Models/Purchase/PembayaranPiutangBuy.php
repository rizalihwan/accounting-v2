<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranPiutangBuy extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pemasok()
    {
        return $this->belongsTo(\App\Models\Kontak::class);
    }
}
