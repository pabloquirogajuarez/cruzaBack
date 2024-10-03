@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center text-white bg-primary py-3 rounded">Detalles del Vendedor</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="mb-4">
                <h4 class="text-muted">Nombre:</h4>
                <p class="font-weight-bold">{{ $vendedor->nombre }}</p>
            </div>

            <div class="mb-4">
                <h4 class="text-muted">DNI:</h4>
                <p class="font-weight-bold">{{ $vendedor->dni }}</p>
            </div>

            <div class="mb-4">
                <h4 class="text-muted">Email:</h4>
                <p class="font-weight-bold">{{ $vendedor->email }}</p>
            </div>

            <div class="mb-4">
                <h4 class="text-muted">Domicilio:</h4>
                <p class="font-weight-bold">{{ $vendedor->domicilio }}</p>
            </div>

            <div class="mb-4">
                <h4 class="text-muted">Fecha de Nacimiento:</h4>
                <p class="font-weight-bold">{{ $vendedor->fechanacimiento }}</p>
            </div>

            <div class="mb-4">
                <h4 class="text-muted">Teléfono:</h4>
                <p class="font-weight-bold">{{ $vendedor->telefono }}</p>
            </div>

            <div class="mb-4">
                <h4 class="text-muted">Estado:</h4>
                <span class="badge badge-{{ $vendedor->estado == 'Activo' ? 'success' : 'secondary' }}">
                    {{ $vendedor->estado }}
                </span>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('vendedores.edit', $vendedor->id) }}" class="btn btn-secondary mr-2">
                    <i class="fas fa-edit"></i> Editar
                </a>
                <form action="{{ route('vendedores.destroy', $vendedor->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('vendedores.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Volver a la lista de vendedores
        </a>
    </div>
</div>
@endsection
