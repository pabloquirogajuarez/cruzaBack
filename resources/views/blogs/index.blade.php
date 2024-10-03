@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Administrar socios</h3>   
            
                     
        </div>


        <div class="col-md-6">

            <div class="input-group mb-3">

                
                <form method="get" action="/search" class="d-flex">
                    <input class="form-control" name="search" placeholder="Buscar...">
                    <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
                </form>
                <a class="nav-link" style="color: black" href="/blogs">
                    <i class="fas fa-sync-alt "></i><span> Click para actualizar lista de empleados</span>
                </a>
            </div>
            <p class="text-muted">* Luego de realizar una búsqueda puede actualizar la lista de empleados para verla completa</p>
            @php
                                                 use App\Models\Blog;
                                                $cant_blogs = Blog::count(); 
                                                                                               
                                                @endphp 
                                                <h4><span class="badge badge-dark">{{$cant_blogs}} empleados en total</span></h4>
            
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('crear-blog')
                            <a class="btn btn-primary mb-3" href="{{ route('blogs.create') }}"><i class="fas fa-plus"></i> Nuevo</a>
                            @endcan

                            <table class="table table-striped mt-2">
                                <thead class="thead-dark">
                                    <tr>
                                        <th style="display: none;">ID</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>DNI</th>
                                        <th>CUIL</th>
                                        <th>Domicilio</th>
                                        <th>Fecha de alta</th>
                                        <th>Vacaciones</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blogs as $blog)
                                    <tr>
                                        <td style="display: none;">{{ $blog->id }}</td>
                                        <td>{{ $blog->nombre }}</td>
                                        <td>{{ $blog->apellido }}</td>
                                        <td>{{ $blog->dni }}</td>
                                        <td>{{ $blog->cuil }}</td>
                                        <td>{{ $blog->domicilio }}</td>
                                        <td>{{ $blog->fechaAlta }}</td>
                                        <td>{{ $blog->vacaciones }}</td>
                                        <td>
                                            <form action="{{ route('blogs.destroy',$blog->id) }}" method="POST">
                                                @can('editar-blog')
                                                <a class="btn btn-info" href="{{ route('blogs.edit',$blog->id) }}"><i class="fas fa-edit"></i></a>
                                                @endcan

                                                @csrf
                                                @method('DELETE')
                                                @can('borrar-blog')
                                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                @endcan
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Ubicamos la paginacion a la derecha -->
                            <div class="d-flex justify-content-end">
                                {!! $blogs->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
