<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BkkDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bkk()
    {
        return $this->belongsTo(Bkk::class, 'bkk_id');
    }

    public function rekening()
    {
        return $this->belongsTo(Akun::class, 'rekening_id');
    }
}
