@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center text-white bg-primary py-3 rounded">Agregar nuevo vendedor</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('vendedores.store') }}">
                @csrf
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="dni">DNI</label>
                    <input type="text" class="form-control" id="dni" name="dni" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="domicilio">Domicilio</label>
                    <input type="text" class="form-control" id="domicilio" name="domicilio" required>
                </div>
                <div class="form-group">
                    <label for="fechanacimiento">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fechanacimiento" name="fechanacimiento" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" required>
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select class="form-control" id="estado" name="estado" required>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('vendedores.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
