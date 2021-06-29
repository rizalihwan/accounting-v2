<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function rekenings()
    {
        return $this->hasMany(Rekening::class);
    }

    public function jurnalumums()
    {
        return $this->hasMany(Jurnalumum::class);
    }
}
