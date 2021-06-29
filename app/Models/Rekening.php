<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function divisi()
    {
        return $this->belongsToMany(Divisi::class, 'divisi_id', 'id');
    }

    public function bank()
    {
        return $this->belongsToMany(Bank::class, 'bank_id', 'id');
    }
    public function uraians()
    {
        return $this->hasMany(Uraian::class);
    }
}
