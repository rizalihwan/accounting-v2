<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeActive($query)
    {
        return $query->where('status', '=', '1');
    }

    public function jurnalumumdetails()
    {
        return $this->hasMany(Jurnalumumdetail::class);
    }

    public function bkk()
    {
        return $this->hasMany(Bkk::class, 'rekening_id', 'id');
    }

    public function faktur_sales()
    {
        return $this->hasMany(\App\Models\Sale\FakturSale::class, 'akun_id');
    }
}
