@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h3 class="page__heading">Gestión de Roles</h3>
            @can('crear-rol')
            <a class="btn btn-warning btn-icon-split" href="{{ route('roles.create') }}">
                <span class="icon text-white-50">
                    <i class="fas fa-plus-circle"></i>
                </span>
                <span class="text">Nuevo Rol</span>
            </a>
            @endcan
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 bg-dark text-white">
                            <h6 class="m-0 font-weight-bold">Listado de Roles</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Rol</th>
                                            <th scope="col" class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $role->name }}</td>
                                            <td class="text-center">
                                                @can('editar-rol')
                                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-edit"></i> Editar
                                                </a>
                                                @endcan
                                                @can('borrar-rol')
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este rol?')">
                                                        <i class="fas fa-trash-alt"></i> Borrar
                                                    </button>
                                                {!! Form::close() !!}
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Paginación centrada -->
                            <div class="d-flex justify-content-end">
                                {!! $roles->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
