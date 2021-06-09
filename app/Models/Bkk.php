<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bkk extends Model
{
    use HasFactory;

    protected $table = 'bkks';
    protected $guarded = [];

    public function uraians()
    {
        return $this->hasMany(Uraian::class);
    }
    public function kontaks()
    {
        return $this->belongsTo(Kontak::class,'kontak_id','id');
    }
}
