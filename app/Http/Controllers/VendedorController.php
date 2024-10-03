<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Models\Vendedor;
use Barryvdh\DomPDF\Facade\Pdf;

class VendedorController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:ver-vendedor|crear-vendedor|editar-vendedor|borrar-vendedor', ['only' => ['index']]);
         $this->middleware('permission:crear-vendedor', ['only' => ['create','store']]);
         $this->middleware('permission:editar-vendedor', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-vendedor', ['only' => ['destroy']]);
    }


    public function index(Request $request)
    {
        // Obtener los vendedores junto con sus empresas activas y socios activos asociados
        $vendedores = Vendedor::with(['empresas' => function($query) {
            $query->where('estadoEmpresa', 'Activa') // Filtrar solo empresas activas
                  ->with(['socios' => function($query) {
                      $query->where('estado', 'Activo'); // Filtrar solo socios activos
                  }]);
        }])->paginate(10);
    
        // Definir los montos por socio con y sin aporte
        $montoConAporte = 100;  // Ajusta estos valores según tu lógica de negocio
        $montoSinAporte = 50;
    
        // Crear un arreglo para almacenar las empresas y su conteo de aportes por vendedor
        $vendedoresComisionData = [];
    
        foreach ($vendedores as $vendedor) {
            $comisionData = []; // Arreglo para almacenar los datos de cada empresa del vendedor
            foreach ($vendedor->empresas as $empresa) {
                $sociosConAportes = $empresa->socios->where('aportes', 'SI')->count();
                $sociosSinAportes = $empresa->socios->where('aportes', 'NO')->count();
                $totalSocios = $sociosConAportes + $sociosSinAportes;
    
                // Solo guardar los datos si hay socios activos
                if ($totalSocios > 0) {
                    $comisionData[] = [
                        'nombreEmpresa' => $empresa->nombreEmpresa,
                        'sociosConAportes' => $sociosConAportes,
                        'sociosSinAportes' => $sociosSinAportes,
                        'totalSocios' => $totalSocios,
                    ];
                }
            }
    
            // Guardar los datos de comisión del vendedor
            $vendedoresComisionData[$vendedor->id] = $comisionData;
        }
    
        // Puedes calcular los totales de activos e inactivos si tienes esa lógica en tu proyecto
        $totalActivos = Vendedor::where('estado', 'Activo')->count();
        $totalInactivos = Vendedor::where('estado', 'Inactivo')->count();
    
        // Retornar la vista con todas las variables necesarias
        return view('vendedores.index', compact('vendedores', 'montoConAporte', 'montoSinAporte', 'totalActivos', 'totalInactivos', 'vendedoresComisionData'));
    }
    


    public function generarComision(Request $request, $vendedorId)
{
    // Obtener el vendedor con sus empresas activas y socios activos
    $vendedor = Vendedor::with(['empresas' => function($query) {
        $query->where('estadoEmpresa', 'Activa') // Filtrar solo empresas activas
              ->with(['socios' => function($query) {
                  $query->where('estado', 'Activo'); // Filtrar solo socios activos
              }]);
    }])->findOrFail($vendedorId);

    // Obtener los montos de la solicitud
    $montoConAporte = $request->query('montoConAporte', 100); // Valor por defecto 100
    $montoSinAporte = $request->query('montoSinAporte', 50); // Valor por defecto 50

    // Crear un arreglo para almacenar las empresas y su conteo de aportes por vendedor
    $vendedoresComisionData = [];

    foreach ($vendedor->empresas as $empresa) {
        // Filtrar los socios activos de la empresa
        $sociosConAportes = $empresa->socios->where('aportes', 'SI')->count();
        $sociosSinAportes = $empresa->socios->where('aportes', 'NO')->count();
        $totalSocios = $sociosConAportes + $sociosSinAportes;

        // Guardar los datos en el arreglo solo si la empresa tiene socios activos
        if ($totalSocios > 0) {
            $vendedoresComisionData[] = [
                'nombreEmpresa' => $empresa->nombreEmpresa,
                'sociosConAportes' => $sociosConAportes,
                'sociosSinAportes' => $sociosSinAportes,
                'totalSocios' => $totalSocios,
            ];
        }
    }

    // Cargar la vista y pasar los datos
    $pdf = PDF::loadView('pdf.comision', compact('vendedor', 'montoConAporte', 'montoSinAporte', 'vendedoresComisionData'));

    // Descargar el PDF
    return $pdf->stream('comision.pdf');
}



    public function buscar(Request $request)
    {
        $search = $request->input('search');
        
        $vendedores = Vendedor::where(function($query) use ($search) {
            $query->where('nombre', 'like', "%{$search}%")
                  ->orWhere('dni', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        })->paginate(10);
        
        $totalActivos = Vendedor::where('estado', 'Activo')->count();
        $totalInactivos = Vendedor::where('estado', 'Inactivo')->count();
        
        return view('vendedores.index', compact('vendedores', 'totalActivos', 'totalInactivos'));
    }

    public function filtrarPorEstado(Request $request)
    {
        // Validar que el estado esté presente
        $request->validate([
            'estado' => 'required|in:Activo,Inactivo'
        ]);

        // Obtener los vendedores filtrados por el estado
        $vendedores = Vendedor::where('estado', $request->input('estado'))->paginate(10);

        // Calcular totales
        $totalActivos = Vendedor::where('estado', 'Activo')->count();
        $totalInactivos = Vendedor::where('estado', 'Inactivo')->count();

        // Retornar la vista con los vendedores filtrados y los totales
        return view('vendedores.index', [
            'vendedores' => $vendedores,
            'totalActivos' => $totalActivos,
            'totalInactivos' => $totalInactivos,
        ]);
    }


    public function toggleEstado($id)
{
    $vendedor = Vendedor::findOrFail($id);

    if ($vendedor->estado == 'Activo') {
        $vendedor->estado = 'Inactivo';
    } else {
        $vendedor->estado = 'Activo';
    }

    $vendedor->save();

    return redirect()->route('vendedores.index')->with('success', 'El estado del vendedor ha sido actualizado.');
}


    public function show($id)
    {
        $vendedor = Vendedor::findOrFail($id);
        return view('vendedores.show', compact('vendedor'));
    }

    public function create()
    {
        return view('vendedores.create');
    }
    

        // Almacenar un nuevo vendedor
        public function store(Request $request)
        {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'dni' => 'required|string|max:255|unique:vendedores,dni',
                'email' => 'required|string|email|max:255|unique:vendedores,email',
                'domicilio' => 'required|string|max:255',
                'fechanacimiento' => 'required|date',
                'telefono' => 'required|string|max:255',
                'estado' => 'required|string|in:Activo,Inactivo',
            ]);
    
            Vendedor::create($request->all());
    
            return redirect()->route('vendedores.index')->with('success', 'Vendedor creado con éxito.');
        }

        public function edit($id)
        {
            // Obtener el vendedor por su ID
            $vendedor = Vendedor::findOrFail($id);
        
            // Retornar la vista para editar el vendedor, pasando el vendedor como variable
            return view('vendedores.edit', compact('vendedor'));
        }

    public function update(Request $request, $id)
    {
        $vendedor = Vendedor::findOrFail($id);
        $vendedor->update($request->all());
        return redirect()->route('vendedores.index');
    }

    public function destroy($id)
    {
        $vendedor = Vendedor::findOrFail($id);
        $vendedor->delete();
        return redirect()->route('vendedores.index');
    }



}
