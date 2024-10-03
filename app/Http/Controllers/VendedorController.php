<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendedor;

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
        $vendedores = Vendedor::paginate(10);
        $totalActivos = Vendedor::where('estado', 'Activo')->count();
        $totalInactivos = Vendedor::where('estado', 'Inactivo')->count();
        return view('vendedores.index', compact('vendedores', 'totalActivos', 'totalInactivos'));
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
            $empresa = Empresa::findOrFail($id);
            $vendedores = Vendedor::all(); // Asegúrate de obtener todos los vendedores
    
            return view('empresas.editar', compact('empresa', 'vendedores'));
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
