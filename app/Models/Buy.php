<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    use HasFactory;

    protected $table = 'penawaran_buys';
    protected $guarded = [];

    public function busdetails()
    {
        return $this->hasMany(BuyDetail::class);
    }
    public function pemasok()
    {
        return $this->belongsTo(Kontak::class,'pemasok_id','id');
    }
}
