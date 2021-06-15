<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uraian extends Model
{
    use HasFactory;
    protected $table = 'uraians';
    protected $filliable  = [
        "rekening_id ", 
        "bkk_id ",
        "jml_uang",
        "catatan",
        "uang"
        ];
    public function bkk()
    {
        return $this->belongsTo(Bkk::class, 'bkk_id', 'id');
    }
    public function rekening()
    {
        return $this->belongsTo(Akun::class, 'rekening_id', 'id');
    }
    
}
