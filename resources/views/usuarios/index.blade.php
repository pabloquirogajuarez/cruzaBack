@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
      <h3 class="page__heading">Usuarios del sistema</h3>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-lg-12">
        <div class="card shadow-sm">
          <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
              <a class="btn btn-warning text-white" href="{{ route('usuarios.create') }}">
                <i class="fas fa-user-plus"></i> + Nuevo
              </a>
            </div>

            <table class="table table-hover table-bordered ">
              <thead class="bg-dark text-white text-center">
                <tr style="color: white">
                  <th style="color: white">Nombre</th>
                  <th style="color: white">E-mail</th>
                  <th style="color: white">Rol</th>
                  <th style="color: white">Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($usuarios as $usuario)
                  <tr>
                    <td style="display: none;">{{ $usuario->id }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td class="text-center">
                      @if(!empty($usuario->getRoleNames()))
                        @foreach($usuario->getRoleNames() as $rolNombre)
                          <span class="badge badge-dark">{{ $rolNombre }}</span>
                        @endforeach
                      @endif
                    </td>
                    <td class="text-center">
                      <a class="btn btn-info btn-sm text-white" href="{{ route('usuarios.edit', $usuario->id) }}">
                        <i class="fas fa-edit"></i> Editar
                      </a>
                      {!! Form::open(['method' => 'DELETE','route' => ['usuarios.destroy', $usuario->id],'style'=>'display:inline']) !!}
                        {!! Form::button('<i class="fas fa-trash-alt"></i> Borrar', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => 'return confirm("¿Estás seguro de que deseas borrar este usuario?")']) !!}
                      {!! Form::close() !!}
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>

            <div class="pagination justify-content-end">
              {!! $usuarios->links() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
