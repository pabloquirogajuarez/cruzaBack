@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="text-center mb-5" style="font-weight: bold; color: white;">Historiales</h4>
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card text-center h-100" style="background: linear-gradient(to bottom, #007bff, #0056b3); border: none; color: white; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold;">Recibos de Empresas</h5>
                    <a href="{{ route('recibos.index') }}" class="btn btn-light">Ver</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-center h-100" style="background: linear-gradient(to bottom, #007bff, #0056b3); border: none; color: white; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold;">Informes de Empresas</h5>
                    <a href="{{ route('historial_informes.index') }}" class="btn btn-light">Ver</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-center h-100" style="background: linear-gradient(to bottom, #28a745, #218838); border: none; color: white; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold;">Retornos de Anticipos de Socios</h5>
                    <a href="{{ route('historial.index') }}" class="btn btn-light">Ver Retornos</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-center h-100" style="background: linear-gradient(to bottom, #ffc107, #e0a800); border: none; color: white; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold;">Historial de Bonificaciones de Socios</h5>
                    <a href="{{ route('historial.bonificaciones.index') }}" class="btn btn-light">Ver Bonificaciones</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
