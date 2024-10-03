<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recibo;
use App\Models\Empresa; // Importa el modelo Empresa
use Barryvdh\DomPDF\Facade\Pdf;

class ReciboController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-recibo|crear-recibo|editar-recibo|borrar-recibo', ['only' => ['index']]);
         $this->middleware('permission:crear-recibo', ['only' => ['create','store']]);
         $this->middleware('permission:editar-recibo', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-recibo', ['only' => ['destroy']]);
    }

    public function index(Request $request)
{
    $search = $request->input('search');

    // Inicializar la consulta de recibos
    $recibos = Recibo::query(); 

    // Filtrar según el término de búsqueda
    if ($search) {
        $recibos->where(function($query) use ($search) {
            $query->where('codigo_recibo', 'LIKE', "%{$search}%")
                  ->orWhereHas('empresa', function($q) use ($search) {
                      $q->where('nombreEmpresa', 'LIKE', "%{$search}%");
                  })
                  ->orWhere('monto', 'LIKE', "%{$search}%")
                  ->orWhereDate('created_at', '=', date('Y-m-d', strtotime($search)));
        });
    }

    // Obtener los recibos filtrados
    $recibos = $recibos->get();

    return view('recibos.index', compact('recibos'));
}

    
    

   // Método para convertir números a letras
   private function numeroALetras($numero)
   {
       $unidades = ['', 'UNO', 'DOS', 'TRES', 'CUATRO', 'CINCO', 'SEIS', 'SIETE', 'OCHO', 'NUEVE'];
       $decenas = ['', 'DIEZ', 'VEINTE', 'TREINTA', 'CUARENTA', 'CINCUENTA', 'SESENTA', 'SETENTA', 'OCHENTA', 'NOVENTA'];
       $centenas = ['', 'CIENTO', 'DOSCIENTOS', 'TRESCIENTOS', 'CUATROCIENTOS', 'QUINIENTOS', 'SEISCIENTOS', 'SETECIENTOS', 'OCHOCIENTOS', 'NOVECIENTOS'];

       $especiales = [
           11 => 'ONCE',
           12 => 'DOCE',
           13 => 'TRECE',
           14 => 'CATORCE',
           15 => 'QUINCE',
           16 => 'DIECISEIS',
           17 => 'DIECISIETE',
           18 => 'DIECIOCHO',
           19 => 'DIECINUEVE',
           21 => 'VEINTIUNO',
           22 => 'VEINTIDOS',
           23 => 'VEINTITRES',
           24 => 'VEINTICUATRO',
           25 => 'VEINTICINCO',
           26 => 'VEINTISEIS',
           27 => 'VEINTISIETE',
           28 => 'VEINTIOCHO',
           29 => 'VEINTINUEVE',
       ];

       if ($numero == 0) {
           return 'CERO';
       }

       $partes = explode('.', number_format($numero, 2, '.', ''));
       $entero = intval($partes[0]);

       $resultado = '';

       if ($entero >= 1000) {
           $miles = intval(floor($entero / 1000));
           $entero = $entero % 1000;
           if ($miles == 1) {
               $resultado .= 'MIL ';
           } else {
               $resultado .= $this->numeroALetras($miles) . ' MIL ';
           }
       }

       if ($entero >= 100) {
           $resultado .= $centenas[intval(floor($entero / 100))] . ' ';
           $entero = $entero % 100;
       }

       if (isset($especiales[$entero])) {
           $resultado .= $especiales[$entero] . ' ';
           $entero = 0;
       } elseif ($entero >= 10) {
           $resultado .= $decenas[intval(floor($entero / 10))];
           $entero = $entero % 10;
           if ($entero > 0) {
               $resultado .= ' Y ' . $unidades[$entero] . ' ';
           }
       } elseif ($entero > 0) {
           $resultado .= $unidades[$entero] . ' ';
       }

       return trim($resultado);
   }

   public function show($codigo_recibo)
   {
       // Buscar el recibo por su código
       $recibo = Recibo::where('codigo_recibo', $codigo_recibo)->firstOrFail();

       // Llamar a la función que ya tienes para generar el PDF
       $pdf = PDF::loadView('pdf.recibos', [
           'empresa' => $recibo->empresa,
           'sociosActivos' => $recibo->empresa->socios->where('estado', 'Activo'),
           'monto' => $recibo->monto,
           'montoEnLetras' => $this->numeroALetras($recibo->monto), // Llamar a la función aquí
           'total' => $recibo->monto,
           'totalConIVA' => $recibo->monto * 1.21,
           'concepto' => $recibo->concepto,
           'codigoRecibo' => $recibo->codigo_recibo
       ]);

       // Devolver el PDF generado en stream para mostrarlo en la vista
       return $pdf->stream('recibo_empresa_' . $recibo->empresa->id . '.pdf');
   }   
   
}



