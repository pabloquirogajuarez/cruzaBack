@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center text-white bg-primary py-3 rounded">Vendedores</h2>

    <div class="col-md-6 mb-4">
    <div class="d-flex align-items-center justify-content-between">
    <form method="get" action="{{ route('vendedores.buscar') }}" class="input-group">
    <input class="form-control" name="search" placeholder="Buscar vendedor (Nombre, DNI o Email)" aria-label="Buscar vendedor">
    <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
</form>

        <a class="nav-link text-black" href="{{ route('vendedores.index') }}">
            <i class="fas fa-sync-alt"></i> <span>Actualizar lista</span>
        </a>
    </div>

    <!-- Mensaje de resultados -->
    @if(request()->has('search'))
        <p class="text-muted">* Luego de realizar una búsqueda, actualiza la lista para ver todos los vendedores.</p>
        <p class="text-success">Estos son los resultados de la búsqueda:</p>
    @endif
</div>

    <div class="col-md-6 mb-4">
    <form method="get" action="{{ route('vendedores.filtrar') }}" class="input-group">
    <select class="form-control" name="estado">
        <option value="">Seleccione un estado...</option>
        <option value="Activo">Vendedores activos</option>
        <option value="Inactivo">Vendedores inactivos</option>
    </select>
    <button class="btn btn-outline-primary" type="submit"><i class="fas fa-filter"></i> Filtrar</button>
</form>

    </div>

    @if(request()->has('estado'))
        <p class="text-muted">* Luego de filtrar, actualiza la lista para ver todos los vendedores.</p>
        <p class="text-success">Estos son los resultados del filtrado:</p>
    @endif

    <div class="mb-4 d-flex">
        <h4 class="mr-3"><span class="badge badge-primary">{{ $vendedores->total() }} vendedores en total</span></h4>
        <h4 class="mr-3"><span class="badge badge-success">{{ $totalActivos }} activos</span></h4>
        <h4 class="mr-3"><span class="badge badge-secondary">{{ $totalInactivos }} inactivos</span></h4>
        <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('vendedores.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Agregar vendedor
        </a>
    </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="bold">
                        <tr>
                            <th class="text-center">Nombre Completo</th>
                            <th class="text-center">DNI</th>                         
                            <th class="text-center">Teléfono</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Comisión</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vendedores as $vendedor)
                            <tr>
                                <td class="text-center">{{ $vendedor->nombre }}</td>
                                <td class="text-center">{{ $vendedor->dni }}</td>
                                
                                <td class="text-center">{{ $vendedor->telefono }}</td>
                                <td class="text-center">
                                    <span class="badge badge-{{ $vendedor->estado == 'Activo' ? 'success' : 'secondary' }}">
                                        {{ $vendedor->estado }}
                                    </span>
                                </td>
                                <td><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalComision{{ $vendedor->id }}">
                                    Ver Comisión
                                </button>
                                </td>
                                <td class="text-center">
                                <div class="d-flex justify-content-end">
    <a href="{{ route('vendedores.edit', $vendedor->id) }}" class="btn btn-secondary mr-2">
        <i class="fas fa-edit"></i> Editar
    </a>
    
    <!-- Botón de dar de alta/baja -->
    <form action="{{ route('vendedores.toggleEstado', $vendedor->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('PUT')
        <button type="submit" class="btn btn-{{ $vendedor->estado == 'Activo' ? 'warning' : 'success' }}">
            <i class="fas fa-toggle-{{ $vendedor->estado == 'Activo' ? 'off' : 'on' }}"></i>
            {{ $vendedor->estado == 'Activo' ? 'Dar de baja' : 'Dar de alta' }}
        </button>
    </form>

    </form>
</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        {{ $vendedores->links() }}
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@foreach($vendedores as $vendedor)
<div class="modal fade" id="modalComision{{ $vendedor->id }}" tabindex="-1" role="dialog" aria-labelledby="modalComisionLabel{{ $vendedor->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalComisionLabel{{ $vendedor->id }}">Comisión del Vendedor: {{ $vendedor->nombre }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="montoConAporte{{ $vendedor->id }}">Monto Con Aporte:</label>
            <input type="number" id="montoConAporte{{ $vendedor->id }}" class="form-control" value="100" min="0">
          </div>
          <div class="form-group">
            <label for="montoSinAporte{{ $vendedor->id }}">Monto Sin Aporte:</label>
            <input type="number" id="montoSinAporte{{ $vendedor->id }}" class="form-control" value="50" min="0">
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead class="thead-light">
                <tr>
                  <th>N°</th>
                  <th>Empresa</th>
                  <th>Aportantes</th>
                  <th>No Aportantes</th>
                  <th>Total Socios</th>
                </tr>
              </thead>
              <tbody>
                @foreach($vendedoresComisionData[$vendedor->id] as $index => $data)
                  <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data['nombreEmpresa'] }}</td>
                    <td>{{ $data['sociosConAportes'] }}</td>
                    <td>{{ $data['sociosSinAportes'] }}</td>
                    <td>{{ $data['totalSocios'] }}</td>
                  </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr class="font-weight-bold">
                  <td colspan="2">Total</td>
                  <td>{{ collect($vendedoresComisionData[$vendedor->id])->sum('sociosConAportes') }}</td>
                  <td>{{ collect($vendedoresComisionData[$vendedor->id])->sum('sociosSinAportes') }}</td>
                  <td>{{ collect($vendedoresComisionData[$vendedor->id])->sum('totalSocios') }}</td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" onclick="generarInforme({{ $vendedor->id }})">Generar Informe de Comisión</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
</div>

<script>
function generarInforme(vendedorId) {
    const montoConAporte = document.getElementById(`montoConAporte${vendedorId}`).value;
    const montoSinAporte = document.getElementById(`montoSinAporte${vendedorId}`).value;
    const url = `{{ route('vendedores.generarComision', '') }}/${vendedorId}?montoConAporte=${montoConAporte}&montoSinAporte=${montoSinAporte}`;
    window.open(url, '_blank');
}
</script>
@endforeach


@endsection
