<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bkk extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bkk_details()
    {
        return $this->hasMany(BkkDetail::class, 'bkk_id');
    }

    public function kontak()
    {
        return $this->belongsTo(Kontak::class,'kontak_id');
    }

    public function akun()
    {
        return $this->belongsTo(Akun::class,'rekening_id');
    }
}
