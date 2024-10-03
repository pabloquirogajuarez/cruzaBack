@extends('layouts.app')

@section('content')
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 20px;
    }

    .switch-input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 20px;
    }

    .slider.round {
        border-radius: 20px;
    }

    .switch-input:checked + .slider {
        background-color: #4CAF50;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 14px;
        width: 14px;
        left: 4px;
        bottom: 3px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    .switch-input:checked + .slider:before {
        transform: translateX(20px);
    }

    .permissions-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .permissions-section {
        background-color: #f8f9fa;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
    }

    .permission-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>

<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Crear Rol</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">

                        {{-- Mensaje de error --}}
                        @if ($errors->any())
                            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                                <strong>¡Revise los campos!</strong>
                                @foreach ($errors->all() as $error)
                                    <span class="badge badge-danger">{{ $error }}</span>
                                @endforeach
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        {{-- Formulario de creación de roles --}}
                        {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                        <div class="row">
                            {{-- Campo de nombre de rol --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="font-weight-bold">Nombre del Rol:</label>
                                    {!! Form::text('name', null, array('class' => 'form-control')) !!}
                                </div>
                            </div>

                            {{-- Sección de permisos --}}
                            <div class="col-md-12">
                                <label class="font-weight-bold">Permisos para este Rol:</label>
                                <div class="permissions-container mt-3">
                                    <div class="row">

                                        {{-- Operaciones sobre Roles --}}
                                        <div class="col-md-5 mb-5">
                                            <div class="permissions-section bg-danger p-3 rounded" style="color: white">
                                                <h5 class="font-weight-bold">Roles del sistema</h5>
                                                <p>Administración del sistema</p>
                                                @foreach(['ver-rol', 'crear-rol', 'editar-rol', 'borrar-rol'] as $permiso)
                                                    <div class="permission-item d-flex justify-content-between align-items-center mt-2">
                                                        <span>{{ ucfirst(str_replace('-', ' ', $permiso)) }}</span>
                                                        <label class="switch">
                                                            {{ Form::checkbox('permission[]', $permission->firstWhere('name', $permiso)->id, false, ['class' => 'switch-input']) }}
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        {{-- Operaciones sobre Usuarios --}}
                                        <div class="col-md-5 mb-5">
                                            <div class="permissions-section bg-danger p-3 rounded" style="color: white">
                                                <h5 class="font-weight-bold">Usuarios del sistema</h5>
                                                <p>Administración del sistema</p>
                                                @foreach(['ver-user', 'crear-user', 'editar-user', 'borrar-user'] as $permiso)
                                                    <div class="permission-item d-flex justify-content-between align-items-center mt-2">
                                                        <span>{{ ucfirst(str_replace('-', ' ', $permiso)) }}</span>
                                                        <label class="switch">
                                                            {{ Form::checkbox('permission[]', $permission->firstWhere('name', $permiso)->id, false, ['class' => 'switch-input']) }}
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        {{-- Operaciones sobre Empresas --}}
                                        <div class="col-md-4 mb-4">
                                            <div class="permissions-section bg-light p-3 rounded">
                                                <h5 class="font-weight-bold">Operaciones sobre Empresas</h5>
                                                @foreach(['ver-empresa', 'crear-empresa', 'editar-empresa', 'borrar-empresa'] as $permiso)
                                                    <div class="permission-item d-flex justify-content-between align-items-center mt-2">
                                                        <span>{{ ucfirst(str_replace('-', ' ', $permiso)) }}</span>
                                                        <label class="switch">
                                                            {{ Form::checkbox('permission[]', $permission->firstWhere('name', $permiso)->id, false, ['class' => 'switch-input']) }}
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        {{-- Operaciones sobre Vendedores --}}
                                        <div class="col-md-4 mb-4">
                                            <div class="permissions-section bg-light p-3 rounded">
                                                <h5 class="font-weight-bold">Operaciones sobre Vendedores</h5>
                                                @foreach(['ver-vendedor', 'crear-vendedor', 'editar-vendedor', 'borrar-vendedor'] as $permiso)
                                                    <div class="permission-item d-flex justify-content-between align-items-center mt-2">
                                                        <span>{{ ucfirst(str_replace('-', ' ', $permiso)) }}</span>
                                                        <label class="switch">
                                                            {{ Form::checkbox('permission[]', $permission->firstWhere('name', $permiso)->id, false, ['class' => 'switch-input']) }}
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        {{-- Operaciones sobre Socios --}}
                                        <div class="col-md-4 mb-4">
                                            <div class="permissions-section bg-light p-3 rounded">
                                                <h5 class="font-weight-bold">Operaciones sobre Socios</h5>
                                                @foreach(['ver-socio', 'crear-socio', 'editar-socio', 'borrar-socio'] as $permiso)
                                                    <div class="permission-item d-flex justify-content-between align-items-center mt-2">
                                                        <span>{{ ucfirst(str_replace('-', ' ', $permiso)) }}</span>
                                                        <label class="switch">
                                                            {{ Form::checkbox('permission[]', $permission->firstWhere('name', $permiso)->id, false, ['class' => 'switch-input']) }}
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        {{-- Operaciones sobre historial --}}
                                        <div class="col-md-4 mb-4">
                                            <div class="permissions-section bg-light p-3 rounded">
                                                <h5 class="font-weight-bold">Operaciones sobre Historial</h5>
                                                @foreach(['ver-socio', 'crear-socio', 'editar-socio', 'borrar-socio'] as $permiso)
                                                    <div class="permission-item d-flex justify-content-between align-items-center mt-2">
                                                        <span>{{ ucfirst(str_replace('-', ' ', $permiso)) }}</span>
                                                        <label class="switch">
                                                            {{ Form::checkbox('permission[]', $permission->firstWhere('name', $permiso)->id, false, ['class' => 'switch-input']) }}
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>

                            {{-- Botón de guardar --}}
                            <div class="col-md-12 text-right mt-4">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection