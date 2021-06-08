<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subklasifikasi extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function akun()
    {
        return $this->hasMany(Akun::class);
    }
}
