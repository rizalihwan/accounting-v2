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

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function getStatusTypeAttribute()
    {
        return $this->status == 1 ? '<span class="badge badge-success">Approved</span>' : '<span class="badge badge-danger">Not Approved</span>';
    }

    public function jurnalumumdetails()
    {
        return $this->hasMany(Jurnalumumdetail::class);
    }
}
