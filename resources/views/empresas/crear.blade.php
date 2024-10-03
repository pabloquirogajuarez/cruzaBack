@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0" style="color:white">Crear Nueva Empresa</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('empresas.store') }}" method="POST">
                        @csrf

                        <div class="row mb-3 align-items-center">
                            <label for="nombreEmpresa" class="col-md-3 col-form-label">Nombre de la Empresa:</label>
                            <div class="col-md-9">
                                <input type="text" name="nombreEmpresa" id="nombreEmpresa" class="form-control" placeholder="Ej. ABC S.A." required>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <label for="apoderadoEmpresa" class="col-md-3 col-form-label">Apoderado de la Empresa:</label>
                            <div class="col-md-9">
                                <input type="text" name="apoderadoEmpresa" id="apoderadoEmpresa" class="form-control" placeholder="Nombre del apoderado" required>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <label for="cuitEmpresa" class="col-md-3 col-form-label">CUIT de la Empresa:</label>
                            <div class="col-md-9">
                                <input type="text" name="cuitEmpresa" id="cuitEmpresa" class="form-control" placeholder="XX-XXXXXXXX-X">
                                <p>Formato: 12-12345678-1</p>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <label for="rubroEmpresa" class="col-md-3 col-form-label">Rubro de la Empresa:</label>
                            <div class="col-md-9">
                                <input type="text" name="rubroEmpresa" id="rubroEmpresa" class="form-control" placeholder="Rubro principal" required>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <label for="direccionEmpresa" class="col-md-3 col-form-label">Dirección de la Empresa:</label>
                            <div class="col-md-9">
                                <input type="text" name="direccionEmpresa" id="direccionEmpresa" class="form-control" placeholder="Calle, número, etc." required>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <label for="provinciaEmpresa" class="col-md-3 col-form-label">Provincia de la Empresa:</label>
                            <div class="col-md-3">
                                <input type="text" name="provinciaEmpresa" id="provinciaEmpresa" class="form-control" placeholder="Provincia" required>
                            </div>

                            <label for="localidadEmpresa" class="col-md-3 col-form-label">Localidad de la Empresa:</label>
                            <div class="col-md-3">
                                <input type="text" name="localidadEmpresa" id="localidadEmpresa" class="form-control" placeholder="Localidad" required>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <label for="estadoEmpresa" class="col-md-3 col-form-label">Estado de la Empresa:</label>
                            <div class="col-md-9">
                                <select name="estadoEmpresa" id="estadoEmpresa" class="form-select" required>
                                    <option value="Activa">Activa</option>
                                    <option value="Inactiva">Inactiva</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <label for="fechaAltaEmpresa" class="col-md-3 col-form-label">Fecha de Alta:</label>
                            <div class="col-md-9">
                                <input type="date" name="fechaAltaEmpresa" id="fechaAltaEmpresa" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
    <label for="vendedor_id" class="col-md-3 col-form-label">Vendedor Asociado:</label>
    <div class="row mb-3 align-items-center">
    <label for="vendedor_id" class="col-md-3 col-form-label">Vendedor Asociado:</label>
    <div class="col-md-9">
        <select name="vendedor_id" id="vendedor_id" class="form-control" required>
            <option value="">Seleccione un vendedor</option>
            @foreach($vendedores as $vendedor)
                <option value="{{ $vendedor->id }}" {{ old('vendedor_id', $empresa->vendedor_id ?? '') == $vendedor->id ? 'selected' : '' }}>
                    {{ $vendedor->nombre }} - DNI: {{ $vendedor->dni }}
                </option>
            @endforeach
        </select>
    </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success w-100">Guardar Empresa</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
