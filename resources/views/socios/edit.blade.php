@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Editar Socio</h1>
    <form action="{{ route('socios.update', $socio->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="empresa_id" value="{{ $socio->empresa_id }}">
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $socio->nombre }}" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $socio->email }}" required>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="dni" class="form-label">DNI</label>
                <input type="text" name="dni" id="dni" class="form-control" value="{{ $socio->dni }}" required>
            </div>
            <div class="col-md-6">
                <label for="domicilio" class="form-label">Domicilio</label>
                <input type="text" name="domicilio" id="domicilio" class="form-control" value="{{ $socio->domicilio }}" required>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="provincia" class="form-label">Provincia</label>
                <input type="text" name="provincia" id="provincia" class="form-control" value="{{ $socio->provincia }}" required>
            </div>
            <div class="col-md-6">
                <label for="localidad" class="form-label">Localidad</label>
                <input type="text" name="localidad" id="localidad" class="form-control" value="{{ $socio->localidad }}" required>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="fechanacimiento" class="form-label">Fecha de Nacimiento</label>
                <input type="date" name="fechanacimiento" id="fechanacimiento" class="form-control" value="{{ $socio->fechanacimiento }}" required>
            </div>
            <div class="col-md-6">
                <label for="telefono1" class="form-label">Teléfono 1</label>
                <input type="text" name="telefono1" id="telefono1" class="form-control" value="{{ $socio->telefono1 }}" required>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="telefono2" class="form-label">Teléfono 2</label>
                <input type="text" name="telefono2" id="telefono2" class="form-control" value="{{ $socio->telefono2 }}">
            </div>
        </div>
        
        <h2 class="mt-4">Datos Organizacionales</h2>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="funcion" class="form-label">Función</label>
                <input type="text" name="funcion" id="funcion" class="form-control" value="{{ $socio->funcion }}" required>
            </div>
            <div class="col-md-6">
    <label for="estado" class="form-label">Estado</label>
    <select name="estado" id="estado" class="form-control" required>
        <option value="Activo">Activo</option>
        <option value="Inactivo">Inactivo</option>
    </select>
</div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="montoSocio"><strong>Monto Socio:</strong></label>
                <input type="text" name="montoSocio" id="montoSocio" class="form-control" value="{{ $socio->montoSocio }}">
            </div>
        </div>


        <div class="row mb-3">
            <div class="col-md-6">
                <label for="a_cargo_de" class="form-label">A Cargo de</label>
                <input type="text" name="a_cargo_de" id="a_cargo_de" class="form-control" value="{{ $socio->a_cargo_de }}">
            </div>
            <div class="col-md-6">
    <label for="aportes" class="form-label">Aportes</label>
    <select name="aportes" id="aportes" class="form-control">
        <option value="SI">SI</option>
        <option value="NO">NO</option>
    </select>
</div>

        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="clave_fiscal" class="form-label">Clave Fiscal</label>
                <input type="text" name="clave_fiscal" id="clave_fiscal" class="form-control" value="{{ $socio->clave_fiscal }}">
            </div>
            <div class="col-md-6">
                <label for="fecha_baja_afip" class="form-label">Fecha Baja AFIP</label>
                <input type="date" name="fecha_baja_afip" id="fecha_baja_afip" class="form-control" value="{{ $socio->fecha_baja_afip }}">
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="documentacion" class="form-label">Documentación</label>
                <input type="text" name="documentacion" id="documentacion" class="form-control" value="{{ $socio->documentacion }}">
            </div>
            <div class="col-md-6">
                <label for="fecha_alta" class="form-label">Fecha Alta</label>
                <input type="date" name="fecha_alta" id="fecha_alta" class="form-control" value="{{ $socio->fecha_alta }}">
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="fecha_baja" class="form-label">Fecha Baja</label>
                <input type="date" name="fecha_baja" id="fecha_baja" class="form-control" value="{{ $socio->fecha_baja }}">
            </div>
            <div class="col-md-6">
                <label for="motivo" class="form-label">Motivo</label>
                <input type="text" name="motivo" id="motivo" class="form-control" value="{{ $socio->motivo }}">
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="lugar_prestamos_servicio" class="form-label">Lugar de Prestamos de Servicio</label>
                <input type="text" name="lugar_prestamos_servicio" id="lugar_prestamos_servicio" class="form-control" value="{{ $socio->lugar_prestamos_servicio }}">
            </div>
        </div>
        
        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea name="observaciones" id="observaciones" class="form-control">{{ $socio->observaciones }}</textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
