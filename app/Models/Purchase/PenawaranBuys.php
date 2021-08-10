<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenawaranBuys extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function pemasok()
    {
        return $this->belongsTo(\App\Models\Kontak::class);
    }

    public function penawaran_details()
    {
        return $this->hasMany(PenawaranBuysDetail::class, 'penawaran_id');
    }
}
