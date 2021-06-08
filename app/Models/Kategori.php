<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kontaks()
    {
        return $this->hasMany(Kontak::class);
    }
}
