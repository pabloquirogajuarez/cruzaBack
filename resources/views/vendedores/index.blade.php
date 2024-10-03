@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center text-white bg-primary py-3 rounded">Vendedores</h2>

    <div class="col-md-6 mb-4">
    <div class="d-flex align-items-center justify-content-between">
    <form method="get" action="{{ route('vendedores.buscar') }}" class="input-group">
    <input class="form-control" name="search" placeholder="Buscar vendedor (Nombre, DNI o Email)" aria-label="Buscar vendedor">
    <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
</form>

        <a class="nav-link text-black" href="{{ route('vendedores.index') }}">
            <i class="fas fa-sync-alt"></i> <span>Actualizar lista</span>
        </a>
    </div>

    <!-- Mensaje de resultados -->
    @if(request()->has('search'))
        <p class="text-muted">* Luego de realizar una búsqueda, actualiza la lista para ver todos los vendedores.</p>
        <p class="text-success">Estos son los resultados de la búsqueda:</p>
    @endif
</div>

    <div class="col-md-6 mb-4">
    <form method="get" action="{{ route('vendedores.filtrar') }}" class="input-group">
    <select class="form-control" name="estado">
        <option value="">Seleccione un estado...</option>
        <option value="Activo">Vendedores activos</option>
        <option value="Inactivo">Vendedores inactivos</option>
    </select>
    <button class="btn btn-outline-primary" type="submit"><i class="fas fa-filter"></i> Filtrar</button>
</form>

    </div>

    @if(request()->has('estado'))
        <p class="text-muted">* Luego de filtrar, actualiza la lista para ver todos los vendedores.</p>
        <p class="text-success">Estos son los resultados del filtrado:</p>
    @endif

    <div class="mb-4 d-flex">
        <h4 class="mr-3"><span class="badge badge-primary">{{ $vendedores->total() }} vendedores en total</span></h4>
        <h4 class="mr-3"><span class="badge badge-success">{{ $totalActivos }} activos</span></h4>
        <h4 class="mr-3"><span class="badge badge-secondary">{{ $totalInactivos }} inactivos</span></h4>
        <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('vendedores.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Agregar vendedor
        </a>
    </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="bold">
                        <tr>
                            <th class="text-center">Nombre Completo</th>
                            <th class="text-center">DNI</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Teléfono</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vendedores as $vendedor)
                            <tr>
                                <td class="text-center">{{ $vendedor->nombre }}</td>
                                <td class="text-center">{{ $vendedor->dni }}</td>
                                <td class="text-center">{{ $vendedor->email }}</td>
                                <td class="text-center">{{ $vendedor->telefono }}</td>
                                <td class="text-center">
                                    <span class="badge badge-{{ $vendedor->estado == 'Activo' ? 'success' : 'secondary' }}">
                                        {{ $vendedor->estado }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('vendedores.show', $vendedor->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        <a href="{{ route('vendedores.edit', $vendedor->id) }}" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <form action="{{ route('vendedores.destroy', $vendedor->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        {{ $vendedores->links() }}
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection
