<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Vendedor;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use App\Models\Recibo;

class EmpresaController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-empresa|crear-empresa|editar-empresa|borrar-empresa', ['only' => ['index']]);
         $this->middleware('permission:crear-empresa', ['only' => ['create','store']]);
         $this->middleware('permission:editar-empresa', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-empresa', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //Con paginación
         $empresas = Empresa::with('socios')->paginate(5);
         return view('empresas.index', compact('empresas'));
         //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $empresas->links() !!} 
    }
    
    public function buscarEmpresas(Request $request)
    {
        $search = $request->input('search');

        $empresas = Empresa::where('nombreEmpresa', 'like', "%{$search}%")
            ->orWhere('apoderadoEmpresa', 'like', "%{$search}%")
            ->orWhere('cuitEmpresa', 'like', "%{$search}%")
            ->paginate(10); // Cambiado de get() a paginate(10)

        return view('empresas.index', compact('empresas'));
    }


    public function filtrarEmpresas(Request $request)
    {
        $estado = $request->input('estado');
    
        $empresas = Empresa::query();
    
        if ($estado) {
            $empresas->where('estadoEmpresa', $estado);
        }
    
        $empresas = $empresas->paginate(10);
    
        return view('empresas.index', compact('empresas'))->with('estado', $estado);
    }
    



    public function generarInforme(Request $request, $id)
{
    $empresa = Empresa::with('socios')->findOrFail($id);
    
    // Filtrar socios activos
    $sociosActivos = $empresa->socios->where('estado', 'Activo');
    
    // Calcular el total sumando los montos de los socios activos
    $total = $sociosActivos->sum('montoSocio');
    
    // Calcular el total con IVA (21%)
    $totalConIVA = $total * 1.21;
    
    // Generar el PDF usando DomPDF
    $pdf = Pdf::loadView('pdf.informe', compact('empresa', 'sociosActivos', 'total', 'totalConIVA'));

    
    return $pdf->stream('informe_empresa_' . $empresa->id . '.pdf');
}

   
   public function generarcobro(Request $request)
    {
        // Obtener solo las empresas activas y contar sus socios activos
        $empresa = Empresa::where('estadoEmpresa', 'Activa')
            ->with(['socios' => function ($query) {
                $query->where('estado', 'activo'); // Filtrar socios activos
            }])
            ->withCount(['socios' => function ($query) {
                $query->where('estado', 'activo'); // Contar socios activos
            }])
            ->get();
    
        // Iterar sobre las empresas y calcular fechas de cobro, prórroga y monto total
        foreach ($empresa as $emp) {
            $fechaAlta = \Carbon\Carbon::parse($emp->fechaAltaEmpresa);
            
            // Fecha de cobro será el mismo día de la fecha de alta pero con el mes y año actual
            $emp->fechaCobro = $fechaAlta->day . '-' . now()->format('m-Y');
            
            // Prórroga agregando 5 días a la fecha de cobro
            $fechaProrroga = \Carbon\Carbon::createFromFormat('d-m-Y', $emp->fechaCobro)->addDays(5);
            $emp->fechaProrroga = $fechaProrroga->format('d-m-Y');
            
            // Calcular el monto total sumando los montos de los socios activos
            $emp->montoTotal = $emp->socios->sum('montoSocio');
        }
    
        // Generar el PDF usando DomPDF
        $pdf = Pdf::loadView('pdf.cobro', compact('empresa'));
    
        // Retornar el PDF como una vista en el navegador
        return $pdf->stream();
    }

    public function generarRecibo(Request $request, Empresa $empresa)
    {
        // Validar los datos del formulario
        $request->validate([
            'monto' => 'required|numeric|min:0',
            'concepto' => 'required|string|max:255',
        ]);

// Generar un código único numérico para el recibo
$codigoRecibo = uniqid(mt_rand(), true);
$codigoRecibo = str_replace('.', '', $codigoRecibo); // Eliminar puntos decimales
$codigoRecibo = substr($codigoRecibo, 0, 15); // Limitar la longitud del código si es necesario

        // Guardar el recibo en la base de datos
        $recibo = new Recibo();
        $recibo->codigo_recibo = $codigoRecibo;
        $recibo->empresa_id = $empresa->id;
        $recibo->monto = $request->input('monto');
        $recibo->concepto = $request->input('concepto');
        $recibo->save();

        // Función para convertir números a letras
        function numeroALetras($numero)
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
                    $resultado .= numeroALetras($miles) . ' MIL ';
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

        // Obtener el monto y concepto del formulario
        $monto = $request->input('monto');
        $concepto = $request->input('concepto');

        // Convertir el monto a letras
        $montoEnLetras = numeroALetras($monto);

        // Obtener los socios activos
        $sociosActivos = $empresa->socios->where('estado', 'Activo');
        $cantidadSociosActivos = $sociosActivos->count();

        // Calcular el total y el total con IVA
        $total = $monto;
        $totalConIVA = $total * 1.21;

        // Generar el PDF usando DomPDF
        $pdf = Pdf::loadView('pdf.recibos', compact('empresa', 'sociosActivos', 'monto', 'montoEnLetras', 'total', 'totalConIVA', 'concepto', 'codigoRecibo'));

        // Devolver el PDF generado para mostrar en el navegador
        return $pdf->stream('recibo_empresa_' . $empresa->id . '.pdf');
    }

    
    
        


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vendedores = Vendedor::all(); // Obtén todos los vendedores
        return view('empresas.crear', compact('vendedores')); // Pasa los vendedores a la vista
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'nombreEmpresa' => 'required',
            'apoderadoEmpresa' => 'required',
            'cuitEmpresa' => 'required',
            'rubroEmpresa' => 'required',
            'direccionEmpresa' => 'required',
            'provinciaEmpresa' => 'required',
            'localidadEmpresa'=> 'required',
            'estadoEmpresa'=> 'required',
            'fechaAltaEmpresa'=> 'required',
            'vendedor_id' => 'nullable|exists:vendedores,id' // Validación para vendedor_id
        ]);
    
        Empresa::create($request->all());
    
        return redirect()->route('empresas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empresa = Empresa::with('socios')->findOrFail($id);
        return view('empresas.show', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        $vendedores = Vendedor::all(); // Obtener todos los vendedores
        return view('empresas.editar', compact('empresa', 'vendedores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresa $empresa)
    {
        request()->validate([
            'nombreEmpresa' => 'required',
            'apoderadoEmpresa' => 'required',
            'cuitEmpresa' => 'required',
            'rubroEmpresa' => 'required',
            'direccionEmpresa' => 'required',
            'provinciaEmpresa' => 'required',
            'localidadEmpresa'=> 'required',
            'estadoEmpresa'=> 'required',
            'fechaAltaEmpresa'=> 'required',
            'vendedor_id' => 'nullable|exists:vendedores,id' // Validación para vendedor_id

        ]);
    
        $empresa->update($request->all());
    
        return redirect()->route('empresas.show', ['empresa' => $empresa->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        $empresa->delete();
    
        return redirect()->route('empresas.index');
    }
}