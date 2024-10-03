@extends('layouts.app')

@section('content')
<section class="section">
    @php
        use App\Models\Empresa;
        use App\Models\Socio;
        $cant_empresas = Empresa::count();
        $empresas_activas = Empresa::where('estadoEmpresa', 'Activa')->count();
        $empresas_inactivas = Empresa::where('estadoEmpresa', 'Inactiva')->count();
        $socios_activos = Socio::where('estado', 'activo')->count();
    @endphp

    <div class="section-header">
        <h3 class="page__heading">Gestión de empresas</h3>
    </div>

    <div class="row mb-4">
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-lg-9 col-md-8 col-sm-12">
                            <form method="get" action="/searchEmpresa" class="input-group">
                                <input class="form-control" name="search" placeholder="Buscar empresa, apoderado o CUIT" aria-label="Buscar empresa">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="fas fa-search"></i> Buscar
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-12 mt-2 mt-md-0">
                            <a class="btn btn-outline-secondary w-100" href="/empresas">
                                <i class="fas fa-sync-alt"></i> Actualizar
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9 col-md-8 col-sm-12">
                            <form method="get" action="/filtrarEmpresas" class="input-group">
                                <select class="form-control" name="estado">
                                    <option value="">Seleccionar estado</option>
                                    <option value="Activa">Activas</option>
                                    <option value="Inactiva">Inactivas</option>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="submit">
                                        <i class="fas fa-filter"></i> Filtrar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12 mt-3 mt-lg-0">
            <div class="card">
                <div class="card-body">
                    @can('crear-empresa')
                    <h5 class="card-title">Resumen</h5>
                    <p class="card-text">
                        <span class="badge badge-success">Total de empresas activas: {{ $empresas_activas }} </span>
                    </p>
                    <p class="card-text">
                        <span class="badge badge-success">Total de socios activos: {{ $socios_activos }} </span>
                    </p>
                    <a href="{{ route('pdf.cobro') }}" class="btn btn-info btn-block" target="_blank">
                        Generar listado de cobro
                    </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    @if(request()->has('search') || request()->has('estado'))
    <div class="alert alert-info" role="alert">
        <p class="mb-0">* Luego de realizar una búsqueda o filtrar, actualiza la lista para ver todas las empresas.</p>
        <p class="mb-0">Estos son los resultados de la {{ request()->has('search') ? 'búsqueda' : 'filtrado' }}:</p>
    </div>
    @endif

    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex flex-column flex-lg-row">
                            @can('crear-empresa')
                            <div class="mb-2 mb-lg-0">
                                <h4><span class="badge badge-primary">{{ $cant_empresas }} empresas en total</span></h4>
                            </div>
                            <div class="mb-2 mb-lg-0 ml-lg-3">
                                <h4><span class="badge badge-success">{{ $empresas_activas }} activas</span></h4>
                            </div>
                            <div class="mb-2 mb-lg-0 ml-lg-3">
                                <h4><span class="badge badge-secondary">{{ $empresas_inactivas }} inactivas</span></h4>
                            </div>
                            <div class="ml-lg-auto">
                                <a class="btn btn-primary" href="{{ route('empresas.create') }}">
                                    <i class="fas fa-plus"></i> Nueva empresa
                                </a>
                            </div>
                            @endcan
                        </div>

                        <!-- Tabla responsiva -->
                        <div class="table-responsive">
                            <table class="table table-hover mt-3">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apoderado</th>
                                        <th>CUIT</th>
                                        <th>Socios</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($empresas as $empresa)
                                    <tr>
                                        <td>{{ $empresa->nombreEmpresa }}</td>
                                        <td>{{ $empresa->apoderadoEmpresa }}</td>
                                        <td>{{ $empresa->cuitEmpresa }}</td>
                                        <td><span class="badge badge-dark"><i class="fa fa-user"></i> {{ $empresa->socios->count() }}</span></td>
                                        <td><span class="badge badge-{{ $empresa->estadoEmpresa == 'Activa' ? 'success' : 'secondary' }}">{{ $empresa->estadoEmpresa }}</span></td>
                                        <td>
                                            <a href="{{ route('empresas.show', $empresa->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> Ver detalles
                                            </a>
                                            @if($empresa->estadoEmpresa === 'Activa')
        <form action="{{ route('empresas.baja', $empresa->id) }}" method="POST" style="display:inline-block;">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de dar de baja a esta empresa? Pondrá inactiva la empresa y a sus socios.')">
                Dar de baja
            </button>
        </form>
    @endif
    @if($empresa->estadoEmpresa === 'Inactiva')
    <form action="{{ route('empresas.alta', $empresa->id) }}" method="POST" style="display:inline-block;">
        @csrf
        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('¿Estás seguro de dar de alta a esta empresa?')">
            Dar de alta
        </button>
    </form>
@endif
@can('borrar-empresa')
<!-- Botón para abrir el modal -->
<button type="button" class="btn btn-danger btn-sm" data-backdrop="false" data-toggle="modal" data-target="#confirmDeleteModal{{ $empresa->id }}">
    <i class="fas fa-trash-alt"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="confirmDeleteModal{{ $empresa->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel{{ $empresa->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel{{ $empresa->id }}">Confirmar eliminación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de eliminar esta empresa para siempre? Esto es irreversible y borrará también a los socios de esta.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form action="{{ route('empresas.destroy', $empresa->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginación -->
                        <div class="d-flex justify-content-end">
                            {!! $empresas->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
