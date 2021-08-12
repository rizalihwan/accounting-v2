<?php

namespace App\Models;

use App\Models\Purchase\PenawaranBuys;
use App\Models\Purchase\PengirimanBuys;
use App\Models\Purchase\PesananBuys;
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

    public function jurnalumums()
    {
        return $this->hasMany(Jurnalumum::class);
    }
    public function Penawaranbuy()
    {
        return $this->hasMany(PenawaranBuys::class);
    }
    public function Pesananbuy()
    {
        return $this->hasMany(PesananBuys::class);
    }
    public function Pengirimanbuy()
    {
        return $this->hasMany(PengirimanBuys::class);
    }
    public function simpans()
    {
        return $this->hasMany(Simpan::class);
    }
}
