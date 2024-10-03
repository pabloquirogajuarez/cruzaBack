@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0" style="color:white">Listado de Recibos [BETA]</h4>
        </div>
        <div class="card-body">
            <table class="table table-hover">
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
                <tbody>
                    @forelse($recibos as $recibo)
                        <tr>
                            <td>{{ $recibo->codigo_recibo }}</td>
                            <td>{{ $recibo->empresa->nombreEmpresa }}</td>
                            <td>{{ $recibo->monto }}</td>
                            <td>{{ $recibo->concepto }}</td>
                            <td>{{ $recibo->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('recibos.show', $recibo->codigo_recibo) }}" class="btn btn-info btn-sm">Ver</a>
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
@endsection
