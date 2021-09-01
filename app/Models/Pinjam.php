<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function nasabah()
    {
        return $this->belongsTo(Kontak::class, 'nasabah_id', 'id');
    }

    public function petugas()
    {
        return $this->belongsTo(Kontak::class, 'petugas_id', 'id');
    }
}
