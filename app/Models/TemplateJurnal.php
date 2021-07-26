<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateJurnal extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function template_details()
    {
        return $this->hasMany(TemplateJurnalDetail::class, 'template_id');
    }

    public function kontak()
    {
        return $this->belongsTo(Kontak::class);
    }
}
