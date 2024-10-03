@extends('layouts.app')

@section('content')
<div class="container mt-5">
 
    <h1 class="mb-4">Detalles del Socio</h1>
    
    <div class="row mb-3">
        <div class="col-md-6">
            <strong>Nombre:</strong> {{ $socio->nombre }}
        </div>
        <div class="col-md-6">
            <strong>Email:</strong> {{ $socio->email }}
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-md-6">
            <strong>DNI:</strong> {{ $socio->dni }}
        </div>
        <div class="col-md-6">
            <strong>Domicilio:</strong> {{ $socio->domicilio }}
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-md-6">
            <strong>Provincia:</strong> {{ $socio->provincia }}
        </div>
        <div class="col-md-6">
            <strong>Localidad:</strong> {{ $socio->localidad }}
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-md-6">
            <strong>Fecha de Nacimiento:</strong> {{ $socio->fechanacimiento }}
        </div>
        <div class="col-md-6">
            <strong>Teléfono 1:</strong> {{ $socio->telefono1 }}
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-md-6">
            <strong>Teléfono 2:</strong> {{ $socio->telefono2 }}
        </div>
    </div>
    
    <h2 class="mt-4">Datos Organizacionales</h2>
    
    <div class="row mb-3">
        <div class="col-md-6">
            <strong>Función:</strong> {{ $socio->funcion }}
        </div>
        <div class="col-md-6">
            <strong>Estado:</strong> {{ $socio->estado }}
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-md-6">
            <strong>A Cargo de:</strong> {{ $socio->a_cargo_de }}
        </div>
        <div class="col-md-6">
            <strong>Aportes:</strong> {{ $socio->aportes }}
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-md-6">
            <strong>Clave Fiscal:</strong> {{ $socio->clave_fiscal }}
        </div>
        <div class="col-md-6">
            <strong>Fecha Baja AFIP:</strong> {{ $socio->fecha_baja_afip }}
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-md-6">
            <strong>Documentación:</strong> {{ $socio->documentacion }}
        </div>
        <div class="col-md-6">
            <strong>Fecha Alta:</strong> {{ $socio->fecha_alta }}
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-md-6">
            <strong>Fecha Baja:</strong> {{ $socio->fecha_baja }}
        </div>
        <div class="col-md-6">
            <strong>Motivo:</strong> {{ $socio->motivo }}
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-md-6">
            <strong>Lugar de Prestamos de Servicio:</strong> {{ $socio->lugar_prestamos_servicio }}
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <strong>Monto Socio:</strong> ${{ number_format($socio->montoSocio, 2) }}
        </div>
    </div>
    
    <div class="mb-3">
        <strong>Observaciones:</strong>
        <p>{{ $socio->observaciones }}</p>
    </div>
    
    <a href="{{ route('socios.edit', $socio->id) }}" class="btn btn-primary">Editar</a>
    <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
</div>
@endsection
