<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informe extends Model
{
    protected $fillable = ['empresa_id', 'socios_activos', 'total', 'total_con_iva'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function socios()
    {
        return $this->hasMany(Socio::class);
    }
}
