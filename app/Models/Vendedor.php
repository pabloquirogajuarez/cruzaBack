<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    use HasFactory;

    protected $table = 'vendedores';

    protected $fillable = [
        'nombre', 'email', 'dni', 'domicilio', 'fechanacimiento', 'telefono', 'estado'
    ];

    public function empresas()
    {
        return $this->hasMany(Empresa::class);
    }
}
