@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0" style="color:white">Historial de Recibos</h4>
        </div>
        <div class="card-body">
            <!-- Campo de búsqueda -->
            <form method="GET" action="{{ route('recibos.index') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por Empresa, Codigo o Monto" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                    </div>
                </div>
            </form>

            @if(request()->has('search'))
            <div class="alert alert-info" role="alert">
                <p class="mb-0">* Luego de realizar una búsqueda, actualiza la lista para ver todos los informes.</p>
                <p class="mb-0">Estos son los resultados de la búsqueda:</p>
                <a href="{{ route('recibos.index') }}" class="btn btn-warning btn-sm mt-2">Actualizar lista</a>
            </div>
            @endif

            <!-- Tab Content -->
            <div class="tab-content" id="myTabContent">
                <!-- Historial de Recibos -->
                <div class="tab-pane fade show active" id="recibos" role="tabpanel" aria-labelledby="recibos-tab">
                    <table class="table table-hover mt-4">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Código</th>
                                <th scope="col">Empresa</th>
                                <th scope="col">Monto</th>
                                <th scope="col">Concepto</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="reciboTable">
                            @forelse($recibos as $recibo)
                                <tr>
                                    <td>{{ $recibo->codigo_recibo }}</td>
                                    <td>{{ $recibo->empresa->nombreEmpresa }}</td>
                                    <td>{{ $recibo->monto }}</td>
                                    <td>{{ $recibo->concepto }}</td>
                                    <td>{{ $recibo->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('recibos.show', $recibo->codigo_recibo) }}" class="btn btn-info btn-sm" target="_blank">Ver</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No se encontraron recibos.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
