@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center text-primary">Detalles del Socio</h1>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h2 class="h5 text-secondary">Información Personal</h2>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nombre" class="form-label fw-bold">Nombre completo</label>
                    <p class="border p-2 rounded">{{ $socio->nombre }}</p>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <p class="border p-2 rounded">{{ $socio->email }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="dni" class="form-label fw-bold">DNI</label>
                    <p class="border p-2 rounded">{{ $socio->dni }}</p>
                </div>
                <div class="col-md-6">
                    <label for="domicilio" class="form-label fw-bold">Domicilio</label>
                    <p class="border p-2 rounded">{{ $socio->domicilio }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="provincia" class="form-label fw-bold">Provincia</label>
                    <p class="border p-2 rounded">{{ $socio->provincia }}</p>
                </div>
                <div class="col-md-6">
                    <label for="localidad" class="form-label fw-bold">Localidad</label>
                    <p class="border p-2 rounded">{{ $socio->localidad }}</p>
                </div>
            </div>

            <div class="row mb-3">
            <div class="col-md-6">
    <label for="fechanacimiento" class="form-label fw-bold">Fecha de Nacimiento</label>
    <p class="border p-2 rounded">{{ \Carbon\Carbon::parse($socio->fechanacimiento)->format('d/m/Y') }}</p>
</div>
                <div class="col-md-6">
                    <label for="telefono1" class="form-label fw-bold">Teléfono 1</label>
                    <p class="border p-2 rounded">{{ $socio->telefono1 }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="telefono2" class="form-label fw-bold">Teléfono 2</label>
                    <p class="border p-2 rounded">{{ $socio->telefono2 }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h2 class="h5 text-secondary">Datos Organizacionales</h2>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="funcion" class="form-label fw-bold">Función</label>
                    <p class="border p-2 rounded">{{ $socio->funcion }}</p>
                </div>
                <div class="col-md-6">
                    <label for="estado" class="form-label fw-bold">Estado</label>
                    <p class="border p-2 rounded">{{ $socio->estado }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="montoSocio" class="form-label fw-bold">Monto Socio</label>
                    <p class="border p-2 rounded">{{ $socio->montoSocio }}</p>
                </div>
                <div class="col-md-6">
                    <label for="aportes" class="form-label fw-bold">Aportes</label>
                    <p class="border p-2 rounded">{{ $socio->aportes }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="clave_fiscal" class="form-label fw-bold">Clave Fiscal AFIP</label>
                    <p class="border p-2 rounded">{{ $socio->clave_fiscal }}</p>
                </div>
                <div class="col-md-6">
                    <label for="fecha_baja_afip" class="form-label fw-bold">Fecha Baja AFIP</label>
                    <p class="border p-2 rounded">{{ $socio->fecha_baja_afip }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="documentacion" class="form-label fw-bold">Documentación faltante</label>
                    <p class="border p-2 rounded">{{ $socio->documentacion }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="fecha_alta" class="form-label fw-bold">Fecha Alta del Socio</label>
                    <p class="border p-2 rounded">{{ $socio->fecha_alta }}</p>
                </div>
                <div class="col-md-6">
                    <label for="fecha_baja" class="form-label fw-bold">Fecha Baja del Socio</label>
                    <p class="border p-2 rounded">{{ $socio->fecha_baja }}</p>
                </div>
                <div class="col-md-6">
                    <label for="motivo" class="form-label fw-bold">Motivo de la baja</label>
                    <p class="border p-2 rounded">{{ $socio->motivo }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="lugar_prestamos_servicio" class="form-label fw-bold">Lugar de Prestamos de Servicio</label>
                    <p class="border p-2 rounded">{{ $socio->lugar_prestamos_servicio }}</p>
                </div>
            </div>

            <div class="mb-3">
                <label for="observaciones" class="form-label fw-bold">Observaciones</label>
                <p class="border p-2 rounded">{{ $socio->observaciones }}</p>
            </div>

            <div class="text-center">
                <a href="javascript:history.back()" class="btn btn-primary">Volver a la lista</a>
            </div>
        </div>
    </div>
</div>
@endsection
