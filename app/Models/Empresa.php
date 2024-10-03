<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombreEmpresa', 'apoderadoEmpresa', 'cuitEmpresa', 'rubroEmpresa', 
        'direccionEmpresa', 'provinciaEmpresa', 'localidadEmpresa', 'estadoEmpresa', 
        'fechaAltaEmpresa', 'vendedor_id'
    ];

    public function socios()
    {
        return $this->hasMany(Socio::class);
    }

    public function vendedor()
    {
        return $this->belongsTo(Vendedor::class);
    }
}
