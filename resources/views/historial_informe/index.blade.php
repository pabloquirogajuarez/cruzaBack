@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4" style="color: white">Historial de Informes</h2>

<!-- Campo de búsqueda -->
<form method="GET" action="{{ route('historial.informes.buscar') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Buscar por Empresa, Total o Fecha" value="{{ request('search') }}">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
        </div>
    </div>
</form>



        @if(request()->has('search'))
        <div class="alert alert-info" role="alert">
            <p class="mb-0">* Luego de realizar una búsqueda, actualiza la lista para ver todos los informes.</p>
            <p class="mb-0">Estos son los resultados de la búsqueda:</p>
            <a href="{{ route('historial.informes') }}" class="btn btn-warning btn-sm mt-2">Actualizar lista</a>
        </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="informeTable">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Empresa</th>
                        <th>Total</th>
                        <th>Total con IVA</th>
                        <th>Fecha de Creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($informes as $informe)
                        <tr>
                            <td>{{ $informe->id }}</td>
                            <td>{{ $informe->empresa->nombreEmpresa }}</td>
                            <td>${{ number_format($informe->total, 2, ',', '.') }}</td>
                            <td>${{ number_format($informe->total_con_iva, 2, ',', '.') }}</td>
                            <td>{{ $informe->created_at->format('d/m/Y - H:i') }}</td>
                            <td>
                                <a href="{{ route('historial_informes.ver', $informe->id) }}" class="btn btn-primary btn-sm">Ver Informe</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No hay informes disponibles.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center">
            {{ $informes->links() }} <!-- Paginación -->
        </div>
    </div>
@endsection
