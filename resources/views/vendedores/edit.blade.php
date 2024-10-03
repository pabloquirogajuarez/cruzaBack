@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center text-white bg-primary py-3 rounded">Editar vendedor</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('vendedores.update', $vendedor->id) }}">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $vendedor->nombre) }}" required>
                </div>
                
                <div class="form-group">
                    <label for="dni">DNI</label>
                    <input type="text" class="form-control" id="dni" name="dni" value="{{ old('dni', $vendedor->dni) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $vendedor->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="domicilio">Domicilio</label>
                    <input type="text" class="form-control" id="domicilio" name="domicilio" value="{{ old('domicilio', $vendedor->domicilio) }}" required>
                </div>

                <div class="form-group">
                    <label for="fechanacimiento">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fechanacimiento" name="fechanacimiento" value="{{ old('fechanacimiento', $vendedor->fechanacimiento) }}" required>
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $vendedor->telefono) }}" required>
                </div>

                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select class="form-control" id="estado" name="estado" required>
                        <option value="Activo" {{ $vendedor->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ $vendedor->estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('vendedores.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
