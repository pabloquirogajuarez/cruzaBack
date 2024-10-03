@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center">Editar Socio</h1>
    <form action="{{ route('socios.update', $socio->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="empresa_id" value="{{ $socio->empresa_id }}">

        <div class="card mb-4">
            <div class="card-body">
                <h2 class="h5">Información Personal</h2>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre completo (*)</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $socio->nombre) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email (*)</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $socio->email) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="dni" class="form-label">DNI (*)</label>
                        <input type="text" name="dni" id="dni" class="form-control" value="{{ old('dni', $socio->dni) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="domicilio" class="form-label">Domicilio (*)</label>
                        <input type="text" name="domicilio" id="domicilio" class="form-control" value="{{ old('domicilio', $socio->domicilio) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="provincia" class="form-label">Provincia (*)</label>
                        <input type="text" name="provincia" id="provincia" class="form-control" value="{{ old('provincia', $socio->provincia) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="localidad" class="form-label">Localidad (*)</label>
                        <input type="text" name="localidad" id="localidad" class="form-control" value="{{ old('localidad', $socio->localidad) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="fechanacimiento" class="form-label">Fecha de Nacimiento (*)</label>
                        <input type="date" name="fechanacimiento" id="fechanacimiento" class="form-control" value="{{ old('fechanacimiento', $socio->fechanacimiento) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="telefono1" class="form-label">Teléfono 1 (*)</label>
                        <input type="text" name="telefono1" id="telefono1" class="form-control" value="{{ old('telefono1', $socio->telefono1) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="telefono2" class="form-label">Teléfono 2</label>
                        <input type="text" name="telefono2" id="telefono2" class="form-control" value="{{ old('telefono2', $socio->telefono2) }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h2 class="h5">Datos Organizacionales</h2>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="funcion" class="form-label">Función (*)</label>
                        <input type="text" name="funcion" id="funcion" class="form-control" value="{{ old('funcion', $socio->funcion) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="estado" class="form-label">Estado (*)</label>
                        <select name="estado" id="estado" class="form-control" required>
                            <option value="Activo" {{ $socio->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ $socio->estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="montoSocio" class="form-label">Monto Socio</label>
                        <input type="number" name="montoSocio" id="montoSocio" class="form-control" value="{{ old('montoSocio', $socio->montoSocio) }}" step="0.01" min="0">
                    </div>
                    <div class="col-md-6">
                        <label for="aportes" class="form-label">Aportes</label>
                        <select name="aportes" id="aportes" class="form-control">
                            <option value="SI" {{ $socio->aportes == 'SI' ? 'selected' : '' }}>SI</option>
                            <option value="NO" {{ $socio->aportes == 'NO' ? 'selected' : '' }}>NO</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="clave_fiscal" class="form-label">Clave Fiscal AFIP</label>
                        <input type="text" name="clave_fiscal" id="clave_fiscal" class="form-control" value="{{ old('clave_fiscal', $socio->clave_fiscal) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="fecha_baja_afip" class="form-label">Fecha Baja AFIP</label>
                        <input type="date" name="fecha_baja_afip" id="fecha_baja_afip" class="form-control" value="{{ old('fecha_baja_afip', $socio->fecha_baja_afip) }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="documentacion" class="form-label">Documentación faltante</label>
                        <input type="text" name="documentacion" id="documentacion" class="form-control" placeholder="Ej. Falta papeleo" value="{{ old('documentacion', $socio->documentacion) }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="fecha_alta" class="form-label">Fecha Alta del Socio (*)</label>
                        <input type="date" name="fecha_alta" id="fecha_alta" class="form-control" value="{{ old('fecha_alta', $socio->fecha_alta) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="fecha_baja" class="form-label">Fecha Baja del Socio</label>
                        <input type="date" name="fecha_baja" id="fecha_baja" class="form-control" value="{{ old('fecha_baja', $socio->fecha_baja) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="motivo" class="form-label">Motivo de la baja</label>
                        <input type="text" name="motivo" id="motivo" class="form-control" value="{{ old('motivo', $socio->motivo) }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="lugar_prestamos_servicio" class="form-label">Lugar de Prestamos de Servicio</label>
                        <input type="text" name="lugar_prestamos_servicio" id="lugar_prestamos_servicio" class="form-control" value="{{ old('lugar_prestamos_servicio', $socio->lugar_prestamos_servicio) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="observaciones" class="form-label">Observaciones</label>
                    <textarea name="observaciones" id="observaciones" class="form-control" rows="3">{{ old('observaciones', $socio->observaciones) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </form>
</div>
@endsection
