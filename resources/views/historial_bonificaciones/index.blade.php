@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4" style="color: white;">Historial de Bonificaciones</h2>
    
    <form method="GET" action="{{ route('historial.bonificaciones.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar por Socio o Empresa" value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            </div>
        </div>
    </form>

    @if(request()->has('search'))
    <div class="alert alert-info" role="alert">
        <p class="mb-0">* Luego de realizar una búsqueda, actualiza la lista para ver todas las empresas.</p>
        <p class="mb-0">Estos son los resultados de la búsqueda:</p>
        <a href="{{ route('historial.bonificaciones.index') }}" class="btn btn-warning btn-sm mt-2">Actualizar lista</a>
    </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Socio</th>
                    <th>Empresa</th>
                    <th>Fecha Desde</th>
                    <th>Fecha Hasta</th>
                    <th>Retribución</th>
                    <th>Neto a Cobrar</th>
                    <th>Fecha de Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($historial as $registro)
                    <tr>
                        <td>{{ $registro->socio_nombre }}</td>
                        <td>{{ $registro->empresa_nombre }}</td>
                        <td>{{ \Carbon\Carbon::parse($registro->fechaDesde)->setTimezone('America/Argentina/Buenos_Aires')->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($registro->fechaHasta)->setTimezone('America/Argentina/Buenos_Aires')->format('d/m/Y') }}</td>
                        <td>${{ number_format($registro->retribucion, 2) }}</td>
                        <td>${{ number_format($registro->neto_a_cobrar, 2) }}</td>
                        <td>{{ \Carbon\Carbon::parse($registro->created_at)->setTimezone('America/Argentina/Buenos_Aires')->format('d/m/Y H:i:s') }}</td>
                        <td>
                            <a href="{{ route('historial.bonificaciones.ver', $registro->id) }}" class="btn btn-primary btn-sm" target="_blank">
                                Ver Bonificación
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
