<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Socio;
use App\Models\Empresa;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SociosExportar;


class SocioController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:ver-socio|crear-socio|editar-socio|borrar-socio', ['only' => ['index']]);
        $this->middleware('permission:crear-user', ['only' => ['create','store']]);
        $this->middleware('permission:editar-user', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-user', ['only' => ['destroy']]);
   }



    public function index()
    {
        // Obtener todos los socios con paginación
        $socios = Socio::paginate(5);
    
        // Contar socios activos e inactivos
        $totalActivos = Socio::where('estado', 'Activo')->count();
        $totalInactivos = Socio::where('estado', 'Inactivo')->count();
    
        // Pasar las variables a la vista
        return view('socios.index', compact('socios', 'totalActivos', 'totalInactivos'));
    }
    


    public function sociosSearch(Request $request) //socios search de empresas.show
{
    $search = $request->input('search');
    $empresa = Empresa::find($request->empresa_id);

    $socios = Socio::where('empresa_id', $empresa->id)
        ->where(function($query) use ($search) {
            $query->where('nombre', 'like', '%' . $search . '%')
                  ->orWhere('dni', 'like', '%' . $search . '%')
                  ->orWhere('funcion', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
        })
        ->get();

    return view('empresas.show', compact('empresa', 'socios'));
}



public function filtrarPorEstado(Request $request)
{
    // Validar que el estado esté presente
    $request->validate([
        'estado' => 'required|in:Activo,Inactivo'
    ]);

    // Obtener los socios filtrados por el estado
    $socios = Socio::where('estado', $request->input('estado'))->paginate(10);

    // Calcular totales
    $totalActivos = Socio::where('estado', 'Activo')->count();
    $totalInactivos = Socio::where('estado', 'Inactivo')->count();

    // Retornar la vista con los socios filtrados y los totales
    return view('socios.index', [
        'socios' => $socios,
        'totalActivos' => $totalActivos,
        'totalInactivos' => $totalInactivos,
    ]);
}





public function buscarSocios(Request $request)
{
    $search = $request->input('search');
    
    // Busca los socios que coincidan con el término de búsqueda y los pagina
    $socios = Socio::where(function($query) use ($search) {
        $query->where('nombre', 'like', '%' . $search . '%')
              ->orWhere('dni', 'like', '%' . $search . '%')
              ->orWhere('funcion', 'like', '%' . $search . '%')
              ->orWhere('email', 'like', '%' . $search . '%');
    })
    ->paginate(10); // Cambia el número de resultados por página según sea necesario

    // Calcular totales
    $totalActivos = Socio::where('estado', 'Activo')->count();
    $totalInactivos = Socio::where('estado', 'Inactivo')->count();

    // Retorna la vista de índice de socios con los resultados
    return view('socios.index', compact('socios', 'totalActivos', 'totalInactivos'));
}


    public function create(Request $request)
    {
        $empresaId = $request->input('empresa_id');
        return view('socios.create', compact('empresaId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'empresa_id' => 'required',
            'nombre' => 'required',
            'email' => 'nullable|string|email|max:255|unique:socios',
            'dni' => 'required|string|max:20',
            'domicilio' => 'required|string|max:255',
            'provincia' => 'required|string|max:255',
            'localidad' => 'required|string|max:255',
            'fechanacimiento' => 'required|date',
            'telefono1' => 'required|string|max:20',
            'telefono2' => 'nullable|string|max:20',
            'funcion' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'a_cargo_de' => 'nullable|string|max:255',
            'aportes' => 'nullable|string|max:255',
            'clave_fiscal' => 'nullable|string|max:255',
            'fecha_baja_afip' => 'nullable|date',
            'documentacion' => 'nullable|string',
            'fecha_alta' => 'required|date',
            'fecha_baja' => 'nullable|date',
            'motivo' => 'nullable|string|max:255',
            'lugar_prestamos_servicio' => 'nullable|string|max:255',
            'observaciones' => 'nullable|string',
            'montoSocio' => 'nullable|numeric|min:0|max:999999999999.99',
        ]);
    
        Socio::create($request->all());
    
        return redirect()->route('empresas.show', ['empresa' => $request->input('empresa_id')])
                         ->with('success', 'Socio agregado exitosamente');
    }
    

    public function show($id)
    {
        $socio = Socio::findOrFail($id);
        return view('socios.show', compact('socio'));
    }

    public function edit($id)
    {
        $socio = Socio::findOrFail($id);
        $empresas = Empresa::all();
        return view('socios.edit', compact('socio', 'empresas'));
    }

    public function update(Request $request, $id)
    {
        $socio = Socio::findOrFail($id);
        $socio->update($request->all());
    
        return redirect()->route('empresas.show', $socio->empresa_id)
                         ->with('success', 'Socio actualizado correctamente');
    }

    public function destroy($id)
    {
        $socio = Socio::findOrFail($id);
        $socio->delete();

        return redirect()->route('socios.index');
    }



    public function generarBonificacionPdf(Request $request, $id)
{
    $socio = Socio::findOrFail($id);

    // Formatear fechas en formato DD/MM/AAAA
    $fechaDesde = \Carbon\Carbon::parse($request->fechaDesde)->format('d/m/Y');
    $fechaHasta = \Carbon\Carbon::parse($request->fechaHasta)->format('d/m/Y');

    // Datos del modal y del socio
    $data = [
        'nombre' => $socio->nombre,
        'dni' => $socio->dni,
        'domicilio' => $socio->empresa->direccionEmpresa,
        'empresa_id' => $socio->empresa->nombreEmpresa,  // Obtiene el nombre de la empresa asociada
        'fechaDesde' => $fechaDesde,
        'fechaHasta' => $fechaHasta,
        'retribucion' => $request->retribucion,
        'retencion1' => $request->retencion1,
        'retencion2' => $request->retencion2,
        'retencion3' => $request->retencion3,
        'retencion4' => $request->retencion4,
        'neto_a_cobrar' => $request->netoACobrar,
    ];

    // Generar PDF con DomPDF
    $pdf = PDF::loadView('pdf.bonificacion', $data);

    return $pdf->stream('bonificacion_socio_' . $socio->dni . '.pdf');
}


public function retornoAnticipoPdf(Request $request, $id)
{
    $socio = Socio::find($id);
    
    // Obtén los datos del request
    $fechaDesde = $request->input('fechaDesde');
    $fechaHasta = $request->input('fechaHasta');
    $retribucion = $request->input('retribucion');
    $retencion1 = $request->input('retencion1');
    $retencion2 = $request->input('retencion2');
    $retencion3 = $request->input('retencion3');
    $retencion4 = $request->input('retencion4');
    $netoACobrar = $retribucion - ($retencion1 + $retencion2 + $retencion3 + $retencion4);

    // Crea un array con los datos a pasar a la vista del PDF
    $data = [
        'nombre' => $socio->nombre,
        'dni' => $socio->dni,
        'domicilio' => $socio->empresa->direccionEmpresa,
        'empresa_id' => $socio->empresa->nombreEmpresa,
        'fechaDesde' => $fechaDesde,
        'fechaHasta' => $fechaHasta,
        'retribucion' => $retribucion,
        'retencion1' => $retencion1,
        'retencion2' => $retencion2,
        'retencion3' => $retencion3,
        'retencion4' => $retencion4,
        'neto_a_cobrar' => $netoACobrar,
    ];

    // Genera el PDF y descárgalo
    $pdf = PDF::loadView('pdf.retorno_anticipo', $data);
    return $pdf->stream('retorno_anticipo.pdf');
}

public function listarSociosActivosexcel()
    {
        $sociosActivos = Socio::where('estado', 'Activo')->get();
        return view('excel.sociosactivo', compact('sociosActivos'));
    }

    public function listarSociosInactivosexcel()
    {
        $sociosInactivos = Socio::where('estado', 'Inactivo')->get();
        return view('excel.sociosinactivos', compact('sociosInactivos'));
    }

    public function exportar($estado)
    {
        return Excel::download(new SociosExportar($estado), "socios_{$estado}.xlsx");
    }
}




namespace App\Exports;

use App\Models\Socio; 
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SociosExportar implements FromView
{
    protected $estado; // Agrega un atributo para el estado de los socios

    public function __construct($estado)
    {
        $this->estado = $estado; // Inicializa el estado en el constructor
    }

    public function view(): View
    {
        // Filtra los socios por estado (activo o inactivo)
        $socios = Socio::where('estado', $this->estado)->get();

        // Devuelve la vista con los datos de los socios
        return view('excel.socios' . ($this->estado === 'Activo' ? 'Activo' : 'Inactivos'), [
            'socios' => $socios,
            'estado' => $this->estado // Asegúrate de pasar el estado para mostrarlo en la vista
        ]);
    }
    public function headings(): array
    {
        return [
            'Nombre',
            'Email',
            'DNI',
            'Domicilio',
            'Provincia',
            'Localidad',
            'Fecha de Nacimiento',
            'Teléfono 1',
            'Teléfono 2',
            'Función',
            'Estado',
            'A Cargo De',
            'Aportes',
            'Clave Fiscal',
            'Fecha Baja AFIP',
            'Documentación',
            'Fecha Alta',
            'Fecha Baja',
            'Motivo',
            'Lugar Prestamos Servicio',
            'Observaciones'
        ];
    }
}


