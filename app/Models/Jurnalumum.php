<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnalumum extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kontak()
    {
        return $this->belongsTo(Kontak::class);
    }

    public function akun()
    {
        return $this->belongsTo(Akun::class);
    }

    public function getStatusTypeAttribute()
    {
        return $this->status == 1 ? '<span class="badge badge-success">Approve</span>' : '<span class="badge badge-danger">Not Approve</span>';
    }

    public function jurnalumumdetails()
    {
        return $this->hasMany(Jurnalumumdetail::class);
    }
}
