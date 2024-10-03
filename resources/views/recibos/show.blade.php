@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white" >
            <h4 class="mb-0" style="color:white"><i class="fas fa-file-invoice-dollar"></i> Detalles del Recibo</h4>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-4"><i class="fas fa-barcode"></i> Código de Recibo:</dt>
                <dd class="col-sm-8">{{ $recibo->codigo_recibo }}</dd>

                <dt class="col-sm-4"><i class="fas fa-building"></i> Empresa:</dt>
                <dd class="col-sm-8">{{ $recibo->empresa->nombreEmpresa }}</dd>

                <dt class="col-sm-4"><i class="fas fa-dollar-sign"></i> Monto:</dt>
                <dd class="col-sm-8">{{ $recibo->monto }}</dd>

                <dt class="col-sm-4"><i class="fas fa-info-circle"></i> En Concepto de:</dt>
                <dd class="col-sm-8">{{ $recibo->concepto }}</dd>

                <dt class="col-sm-4"><i class="fas fa-calendar-alt"></i> Fecha:</dt>
                <dd class="col-sm-8">{{ $recibo->created_at->format('d/m/Y') }}</dd>
            </dl>
        </div>
    </div>
</div>
@endsection
