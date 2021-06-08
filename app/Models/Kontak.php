<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $table = 'kontaks';

    use HasFactory;
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    public function bkk()
    {
        return $this->hasMany(Bkk::class);
    }
}
