@extends('layouts.app')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Detalles de la Empresa</h3>
        
    </div>
    


    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg rounded">
                    <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                        <h4 class="card-title mb-0" style="color:white">Información de <span class="bold">{{ $empresa->nombreEmpresa }}</span> </h4>
                        <a href="{{ route('empresas.edit', ['empresa' => $empresa->id]) }}" class="btn btn-dark">
                            <i class="fas fa-edit"></i> Editar Empresa
                        </a>

                        <div class="justify-content-between">
    <!-- Botón para abrir el modal -->
    <a href="{{ route('empresas.generar-informe', $empresa->id) }}"class="btn btn-info  " target="_blank" ><i class="fas fa-file-pdf"></i>Generar informe</a>
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#generarReciboModal">
    <i class="fas fa-file-pdf"></i> Generar Recibo
</button>

</div>

  <!-- Modal para generar recibo -->
  <div class="modal fade" id="generarReciboModal" tabindex="-1" data-backdrop="false" role="dialog" aria-labelledby="generarReciboModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-info text-white">
                                        <h5 class="modal-title" id="generarReciboModalLabel">Generar Recibo</h5>
                                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>

                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Formulario dentro del modal -->
                                        <form action="{{ route('empresas.generar-recibo', ['empresa' => $empresa->id]) }}" method="POST" target="_blank">
                                            @csrf
                                            <div class="form-group">
                                                <label for="monto">Monto:</label>
                                                <input type="number" name="monto" id="monto" class="form-control" placeholder="Ingrese el monto" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="concepto">En Concepto de:</label>
                                                <input type="text" name="concepto" id="concepto" class="form-control" placeholder="Ingrese el concepto" required>
                                            </div>
                                            
                                            <!-- Mostrar total y total + IVA -->
                                            <p><span class="badge badge-primary">{{ $empresa->socios->where('estado', 'Activo')->count() }} socios activos</span></p>
                                            <div class="form-group">
                                                <label>Total:</label>
                                                <p id="totalRecibo" style="font-weight: bold; color:black;">$0</p>
                                            </div>
                                            <div class="form-group">
                                                <label>Total + IVA (21%):</label>
                                                <p id="totalIVARecibo" style="font-weight: bold; color:black;">$0</p>
                                            </div>

                                            <button type="submit" class="btn btn-success btn-block">
                                                <i class="fas fa-download"></i> Descargar Recibo
                                            </button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <script>
    document.getElementById('monto').addEventListener('input', function() {
        const montoPorSocio = parseFloat(this.value) || 0;
        const totalIVA = montoPorSocio * 1.21;

        const options = { style: 'currency', currency: 'ARS', minimumFractionDigits: 2 };

        document.getElementById('totalRecibo').textContent = montoPorSocio.toLocaleString('es-AR', options);
        document.getElementById('totalIVARecibo').textContent = totalIVA.toLocaleString('es-AR', options);
    });
</script>





</div>


                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <p><i class="fas fa-user-tie text-primary"></i> <span class="text-muted">Apoderado:</span> <strong>{{ $empresa->apoderadoEmpresa }}</strong></p>
                                <p><i class="fas fa-id-card text-primary"></i> <span class="text-muted">CUIT:</span> <strong>{{ $empresa->cuitEmpresa }}</strong></p>
                                <p><i class="fas fa-industry text-primary"></i> <span class="text-muted">Rubro:</span> <strong>{{ $empresa->rubroEmpresa }}</strong></p>
                                <p><i class="fas fa-map-marker-alt text-primary"></i> <span class="text-muted">Dirección:</span> <strong>{{ $empresa->direccionEmpresa }}</strong></p>
                            </div>
                            <div class="col-md-6">
                                <p><i class="fas fa-map-marker-alt text-primary"></i> <span class="text-muted">Provincia:</span> <strong>{{ $empresa->provinciaEmpresa }}</strong></p>
                                <p><i class="fas fa-map-marker-alt text-primary"></i> <span class="text-muted">Localidad:</span> <strong>{{ $empresa->localidadEmpresa }}</strong></p>
                                <p><i class="fas fa-info-circle text-primary"></i> <span class="text-muted">Estado:</span> <strong>{{ $empresa->estadoEmpresa }}</strong></p>
                                <p><i class="fas fa-calendar-alt text-primary"></i> <span class="text-muted">Fecha de Alta:</span> <strong>{{ \Carbon\Carbon::parse($empresa->fechaAltaEmpresa)->format('d/m/Y') }}</strong></p>
                                <p><i class="fas fa-user text-primary"></i> <span class="text-muted">Vendedor Asociado:</span> <strong>{{ $empresa->vendedor->nombre }}</strong></p>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title mb-0" style="color:white">
                                            <i class="fa fa-users" aria-hidden="true"></i> Socios
                                        </h4>
                                        <h4 class="ml-3">
                                            <span class="badge badge-white">{{ $empresa->socios->count() }} en esta empresa</span>
                                        </h4>
                                        <h4 class="ml-3">
    <span class="badge badge-success">{{ $empresa->socios->where('estado', 'Activo')->count() }} Activos</span>
                                        </h4>
                                        <h4 class="ml-3">
    <span class="badge badge-secondary">{{ $empresa->socios->where('estado', 'Inactivo')->count() }} Inactivos</span>
                                        </h4>
                                    </div>
                                    <a href="{{ route('socios.create', ['empresa_id' => $empresa->id]) }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-plus-circle"></i> Agregar Socio
                                    </a>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <form method="get" action="{{ route('socios.search') }}" class="input-group">
                                            <input type="hidden" name="empresa_id" value="{{ $empresa->id }}">
                                            <input class="form-control" name="search" placeholder="Buscar socio (Nombre, DNI, Función o Email)" aria-label="Buscar socio">
                                            <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                                        </form>

                                        <a class="nav-link text-black" href="{{ route('empresas.show', ['empresa' => $empresa->id]) }}">
                                            <i class="fas fa-sync-alt"></i> <span>Actualizar lista</span>
                                        </a>
                                    </div>
                                                                            <!-- Mensaje de resultados -->
                                                                            @if(request()->has('search'))
                                <p class="text-muted">* Luego de realizar una búsqueda, actualiza la lista para ver todos los socios.</p>
                                <p class="text-success">Estos son los resultados de la busqueda:</p>
                                @endif
                                </div>



                                <!-- Tabla de Socios -->
                                <table class="table table-striped table-hover mt-3" style="background-color: white;">
                                    <thead>
                                        <tr class="text-center">
                                            <th style="color: black;">Nombre completo</th>
                                            <th style="color: black;">DNI</th>
                                            <th style="color: black;">Función</th>
                                            <th style="color: black;">Aportes</th>
                                            <th style="color: black;">Estado</th>
                                            <th style="color: black;">Generar Recibo</th>
                                            <th style="color: black;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $sociosList = $socios ?? $empresa->socios;
                                        @endphp
                                        @foreach($sociosList as $socio)
                                            <tr class="text-center">
                                                <td style="color: black;">{{ $socio->nombre }}</td>
                                                <td style="color: black;">{{ $socio->dni }}</td>
                                                <td style="color: black;">{{ $socio->funcion }}</td>
                                                <td style="color: black;">{{ $socio->aportes }}</td>
                                                <td style="color: black;"><span class="badge badge-{{ $socio->estado == 'Activo' ? 'success' : 'secondary' }}">{{ $socio->estado }}</span></td>
                                                <td class="text-center d-flex">
    <button type="button" class="btn btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#retornoAnticipoModal" onclick="setSocioId({{ $socio->id }}, '{{ $socio->nombre }}')">
        Retorno de Ant.</button>
    <button type="button" class="btn btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#bonificacionModal" onclick="setSocioId({{ $socio->id }}, '{{ $socio->nombre }}')">
        Bonif.</button>
                                                <td class="">
                                                    <a href="{{ route('socios.show', ['socio' => $socio->id]) }}" class="btn btn-sm" style="background-color: white; color: black; border: 1px solid black;">
                                                        <i class="fas fa-eye"></i> Ver
                                                    </a>
                                                    <a href="{{ route('socios.edit', ['socio' => $socio->id]) }}" class="btn btn-sm" style="background-color: white; color: black; border: 1px solid black;">
                                                        <i class="fas fa-edit"></i> Editar
                                                    </a>
                                                    <form action="{{ route('socios.destroy', ['socio' => $socio->id]) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este socio?')" style="background-color: red; color: white;"> 
                                                            <i class="fas fa-trash"></i> Eliminar
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-start">
                            <a class="btn btn-outline-primary" href="{{ route('empresas.index') }}">
                                <i class="fas fa-arrow-left"></i> Volver a la lista de empresas
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


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
