@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0" style="color:white">Editar Empresa</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('empresas.update', $empresa->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3 align-items-center">
                            <label for="nombreEmpresa" class="col-md-3 col-form-label">Nombre de la Empresa:</label>
                            <div class="col-md-9">
                                <input type="text" name="nombreEmpresa" id="nombreEmpresa" class="form-control" value="{{ $empresa->nombreEmpresa }}" required>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <label for="apoderadoEmpresa" class="col-md-3 col-form-label">Apoderado de la Empresa:</label>
                            <div class="col-md-9">
                                <input type="text" name="apoderadoEmpresa" id="apoderadoEmpresa" class="form-control" value="{{ $empresa->apoderadoEmpresa }}" required>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
    <label for="cuitEmpresa" class="col-md-3 col-form-label">CUIT de la Empresa:</label>
    <div class="col-md-9">
        <input type="text" name="cuitEmpresa" id="cuitEmpresa" class="form-control" value="{{ $empresa->cuitEmpresa }}" required pattern="\d{2}-\d{8}-\d{1}" title="El CUIT debe tener el formato XX-XXXXXXXX-X">
    </div>
</div>


                        <div class="row mb-3 align-items-center">
                            <label for="rubroEmpresa" class="col-md-3 col-form-label">Rubro de la Empresa:</label>
                            <div class="col-md-9">
                                <input type="text" name="rubroEmpresa" id="rubroEmpresa" class="form-control" value="{{ $empresa->rubroEmpresa }}" required>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <label for="direccionEmpresa" class="col-md-3 col-form-label">Dirección de la Empresa:</label>
                            <div class="col-md-9">
                                <input type="text" name="direccionEmpresa" id="direccionEmpresa" class="form-control" value="{{ $empresa->direccionEmpresa }}" required>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <label for="provinciaEmpresa" class="col-md-3 col-form-label">Provincia de la Empresa:</label>
                            <div class="col-md-3">
                                <input type="text" name="provinciaEmpresa" id="provinciaEmpresa" class="form-control" value="{{ $empresa->provinciaEmpresa }}" required>
                            </div>

                            <label for="localidadEmpresa" class="col-md-3 col-form-label">Localidad de la Empresa:</label>
                            <div class="col-md-3">
                                <input type="text" name="localidadEmpresa" id="localidadEmpresa" class="form-control" value="{{ $empresa->localidadEmpresa }}" required>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <label for="estadoEmpresa" class="col-md-3 col-form-label">Estado de la Empresa:</label>
                            <div class="col-md-9">
                                <select name="estadoEmpresa" id="estadoEmpresa" class="form-control" required>
                                    <option value="Activa" {{ $empresa->estadoEmpresa == 'Activa' ? 'selected' : '' }}>Activa</option>
                                    <option value="Inactiva" {{ $empresa->estadoEmpresa == 'Inactiva' ? 'selected' : '' }}>Inactiva</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <label for="fechaAltaEmpresa" class="col-md-3 col-form-label">Fecha de Alta:</label>
                            <div class="col-md-9">
                                <input type="date" name="fechaAltaEmpresa" id="fechaAltaEmpresa" class="form-control" value="{{ $empresa->fechaAltaEmpresa }}" required>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
    <label for="vendedor_id" class="col-md-3 col-form-label">Vendedor Asociado:</label>
    <div class="col-md-9">
        <select name="vendedor_id" id="vendedor_id" class="form-control required">
            <option value="">Seleccione un vendedor</option>
            @foreach($vendedores as $vendedor)
                <option value="{{ $vendedor->id }}" {{ old('vendedor_id', $empresa->vendedor_id ?? '') == $vendedor->id ? 'selected' : '' }}>
                    {{ $vendedor->nombre }} - DNI: {{ $vendedor->dni }}
                </option>
            @endforeach
        </select>
    </div>
</div>

                        <div class="row mb-3 align-items-center">
                            <div class="col-md-9 offset-md-3">
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
