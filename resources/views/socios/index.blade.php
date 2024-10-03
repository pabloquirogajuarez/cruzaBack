@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center text-white bg-primary py-3 rounded">Lista total de socios</h2>

    <div class="col-md-6 mb-4">
        <div class="d-flex align-items-center justify-content-between">
            <form method="get" action="{{ route('socios.buscar') }}" class="input-group">
                <input class="form-control" name="search" placeholder="Buscar socio (Nombre, DNI o Función)" aria-label="Buscar socio">
                <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
            </form>

            <a class="nav-link text-black" href="{{ route('socios.index') }}">
                <i class="fas fa-sync-alt"></i> <span>Actualizar lista</span>
            </a>
        </div>

        <!-- Mensaje de resultados -->
        @if(request()->has('search'))
            <p class="text-muted">* Luego de realizar una búsqueda, actualiza la lista para ver todos los socios.</p>
            <p class="text-success">Estos son los resultados de la búsqueda:</p>
        @endif
    </div>

    <div class="col-md-6 mb-4">
        <form method="get" action="{{ route('socios.filtrar') }}" class="input-group">
            <select class="form-control" name="estado">
                <option value="">Seleccione un estado...</option>
                <option value="Activo">Socios activos</option>
                <option value="Inactivo">Socios inactivos</option>
            </select>
            <button class="btn btn-outline-primary" type="submit"><i class="fas fa-filter"></i> Filtrar</button>
        </form>
    </div>

    @if(request()->has('estado'))
        <p class="text-muted">* Luego de filtrar, actualiza la lista para ver todos los socios.</p>
        <p class="text-success">Estos son los resultados del filtrado:</p>
    @endif

    <div class="mb-4 d-flex">
        <h4 class="mr-3"><span class="badge badge-primary">{{ $socios->total() }} socios en total</span></h4>
        <h4 class="mr-3"><span class="badge badge-success">{{ $totalActivos }} activos</span></h4>
        <h4 class="mr-3"><span class="badge badge-secondary">{{ $totalInactivos }} inactivos</span></h4>
        <div class="d-flex justify-content-end mb-3">
        </div>
    </div>
    <div class=" justify-content-between ">
       <a class="btn btn-success" href="{{ route('exportar.socios', ['estado' => 'Activo']) }}">Exportar Socios activos excel</a>
        
    
         <a class="btn btn-success" href="{{ route('exportar.socios', ['estado' => 'Inactivo']) }}">Exportar Socios Inactivos excel</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="bold">
                        <tr>
                            <th class="text-center">Nombre Completo</th>
                            <th class="text-center">DNI</th>
                            <th class="text-center">Función</th>
                            <th class="text-center">Empresa</th>
                            <th class="text-center">Aportes</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Generar recibos</th>
                            <th class="text-center">Acciones</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($socios as $socio)
                            <tr>
                                <td class="text-center">{{ $socio->nombre }}</td>
                                <td class="text-center">{{ $socio->dni }}</td>
                                <td class="text-center">{{ $socio->funcion }}</td>
                                <td class="text-center">{{ $socio->empresa->nombreEmpresa }}</td>
                                <td class="text-center">{{ $socio->aportes }}</td>
                                <td class="text-center">
                                    <span class="badge badge-{{ $socio->estado == 'Activo' ? 'success' : 'secondary' }}">
                                        {{ $socio->estado }}
                                    </span>
                                </td>
                                <td class="text-center d-flex">
    <button type="button" class="btn btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#retornoAnticipoModal" onclick="setSocioId({{ $socio->id }}, '{{ $socio->nombre }}')">
        Retorno de Ant.</button>
    <button type="button" class="btn btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#bonificacionModal" onclick="setSocioId({{ $socio->id }}, '{{ $socio->nombre }}')">
        Bonif.</button>
</td>


                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('socios.show', $socio->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        <a href="{{ route('socios.edit', $socio->id) }}" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <form action="{{ route('socios.destroy', $socio->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
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

    <!-- Paginación -->
    <div class="d-flex justify-content-end">
        {{ $socios->links() }}
    </div>
</div>

<!-- Modal para Retorno de Anticipo -->
<div class="modal fade" id="retornoAnticipoModal" tabindex="-1" aria-labelledby="retornoAnticipoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="retornoAnticipoModalLabel">Retorno de Anticipo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="retornoAnticipoForm" action="{{ route('socios.retornoAnticipoPdf', 0) }}" method="POST" target="_blank">
                        @csrf
                        <input type="hidden" id="socioId" name="socioId" value="">
                        <p>Nombre y Apellido: <span id="socioNombre"></span></p>

                        <div class="row mb-3">
                            <div class="col">
                                <label for="fechaDesde" class="form-label">Desde:</label>
                                <input type="date" class="form-control" id="fechaDesde" name="fechaDesde" required>
                            </div>
                            <div class="col">
                                <label for="fechaHasta" class="form-label">Hasta:</label>
                                <input type="date" class="form-control" id="fechaHasta" name="fechaHasta" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="retribucion" class="form-label">Retribución:</label>
                            <input type="number" class="form-control" id="retribucion" name="retribucion" oninput="calcularNeto()" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="retencion1" class="form-label"><span>Ret. Aporte Jubilatorio</span>:</label>
                                <input type="number" class="form-control" id="retencion1" name="retencion1" oninput="calcularNeto()">
                            </div>
                            <div class="col">
                                <label for="retencion2" class="form-label">Ret. Impuesto Integrado:</label>
                                <input type="number" class="form-control" id="retencion2" name="retencion2" oninput="calcularNeto()">
                            </div>
                            <div class="col">
                                <label for="retencion3" class="form-label">Ret. Obra social:</label>
                                <input type="number" class="form-control" id="retencion3" name="retencion3" oninput="calcularNeto()">
                            </div>
                            <div class="col">
                                <label for="retencion4" class="form-label">Otras retenciones:</label>
                                <input type="number" class="form-control" id="retencion4" name="retencion4" oninput="calcularNeto()">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="netoACobrar" class="form-label fw-bold">NETO A COBRAR:</label>
                            <input type="text" class="form-control" id="netoACobrar" name="netoACobrar" readonly>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="limpiarFormulario('retornoAnticipoForm')">Cerrar</button>
                    <button type="submit" class="btn btn-primary" form="retornoAnticipoForm">Generar PDF</button>
                </div>
            </div>
        </div>
    </div>



<!-- Modal para Bonificación -->
<div class="modal fade" id="bonificacionModal" tabindex="-1" aria-labelledby="bonificacionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="bonificacionModalLabel">Generar Bonificación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="bonificacionForm" action="{{ route('socios.bonificacionPdf', 0) }}" method="POST" target="_blank">
                    @csrf
                    <input type="hidden" id="socioId" name="socioId" value="">

                    <p>Nombre y Apellido: <span id="socioNombre"></span></p>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="fechaDesde" class="form-label">Desde:</label>
                            <input type="date" class="form-control" id="fechaDesde" name="fechaDesde" required>
                        </div>
                        <div class="col">
                            <label for="fechaHasta" class="form-label">Hasta:</label>
                            <input type="date" class="form-control" id="fechaHasta" name="fechaHasta" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="retribucion" class="form-label">Retribución:</label>
                        <input type="number" class="form-control" id="retribucion" name="retribucion" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" form="bonificacionForm">Generar PDF</button>
            </div>
        </div>
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


<!-- Scripts adicionales -->
<script>
        function setSocioId(id, nombre) {
            // Cambia el campo oculto con el id del socio
            document.getElementById('socioId').value = id;
            
            // Actualiza el nombre del socio en los modales
            document.querySelectorAll('#socioNombre').forEach(element => {
                element.textContent = nombre;
            });
            
            // Actualiza el action del formulario con el ID del socio seleccionado
            document.getElementById('bonificacionForm').action = document.getElementById('bonificacionForm').action.replace('/0', '/' + id);
            document.getElementById('retornoAnticipoForm').action = document.getElementById('retornoAnticipoForm').action.replace('/0', '/' + id);
        }

        function calcularNeto() {
            const retribucion = parseFloat(document.getElementById('retribucion').value) || 0;
            const retencion1 = parseFloat(document.getElementById('retencion1').value) || 0;
            const retencion2 = parseFloat(document.getElementById('retencion2').value) || 0;
            const retencion3 = parseFloat(document.getElementById('retencion3').value) || 0;
            const retencion4 = parseFloat(document.getElementById('retencion4').value) || 0;
            
            const netoACobrar = retribucion - (retencion1 + retencion2 + retencion3 + retencion4);
            
            document.getElementById('netoACobrar').value = netoACobrar.toFixed(2);
        }

        function limpiarFormulario(formId) {
    const form = document.getElementById(formId);
    if (form) {
        form.reset();  // Resetea todos los campos del formulario
        // Limpia los campos de NETO A COBRAR y los datos del socio
        document.getElementById('netoACobrar').value = '';
        document.getElementById('socioId').value = '';
        document.querySelectorAll('#socioNombre').forEach(element => element.textContent = '');
    }
}

    // Escuchar el evento de cierre de los modales por ahora fix
    document.addEventListener('DOMContentLoaded', function () {
        var modals = document.querySelectorAll('.modal');

        modals.forEach(function (modal) {
            modal.addEventListener('hidden.bs.modal', function () {
                location.reload(); // Actualiza la página al cerrar el modal
            });
        });
    });
    </script>

@endsection
