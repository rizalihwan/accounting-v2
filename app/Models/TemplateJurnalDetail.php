<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateJurnalDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function template()
    {
        return $this->belongsTo(TemplateJurnal::class, 'template_id');
    }

    public function akun()
    {
        return $this->belongsTo(Akun::class);
    }
}
