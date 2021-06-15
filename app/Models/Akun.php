<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function subklasifikasi()
    {
        return $this->belongsTo(Subklasifikasi::class);
    }
    public function jurnalumums()
    {
        return $this->hasMany(Jurnalumum::class);
    }
}
