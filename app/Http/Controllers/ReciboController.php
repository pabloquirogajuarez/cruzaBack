<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recibo;

class ReciboController extends Controller
{
    public function index()
    {
        $recibos = Recibo::all(); // O usa otro método para obtener los recibos que necesitas
        return view('recibos.index', compact('recibos'));
    }
    

public function show($codigo)
{
    $recibo = Recibo::where('codigo_recibo', $codigo)->firstOrFail();
    return view('recibos.show', compact('recibo'));
}
}

