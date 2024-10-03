<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{
    use HasFactory;

    protected $fillable = [
        'empresa_id', 'nombre', 'email', 'dni', 'domicilio', 'provincia', 'localidad', 
        'fechanacimiento', 'telefono1', 'telefono2', 'funcion', 'estado', 'a_cargo_de', 
        'aportes', 'clave_fiscal', 'fecha_baja_afip', 'documentacion', 'fecha_alta', 
        'fecha_baja', 'motivo', 'lugar_prestamos_servicio', 'observaciones','montoSocio'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
