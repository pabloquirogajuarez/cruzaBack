<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    protected $fillable = ['codigo_recibo', 'empresa_id', 'monto', 'concepto'];

    // Definir la relación con la tabla Empresa
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
