@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Empleado</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">                            
                   
                        @if ($errors->any())                                                
                            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>                        
                                @foreach ($errors->all() as $error)                                    
                                    <span class="badge badge-danger">{{ $error }}</span>
                                @endforeach                        
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            </div>
                        @endif


                    <form action="{{ route('blogs.update',$blog->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="nombre">Nombre</label>
                                   <input type="text" name="nombre" class="form-control" value="{{ $blog->nombre }}" placeholder="Ingrese el nombre">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="apellido">Apellido</label>
                                   <input type="text" name="apellido" class="form-control" value="{{ $blog->apellido }}" placeholder="Ingrese el apellido">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="dni">DNI</label>
                                   <input type="text" name="dni" class="form-control" value="{{ $blog->dni }}" placeholder="Ingrese el DNI">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="cuil">CUIL</label>
                                   <input type="text" name="cuil" class="form-control" value="{{ $blog->cuil }}" placeholder="Ingrese el CUIL">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="domicilio">Domicilio</label>
                                   <textarea class="form-control" name="domicilio" style="height: 100px" placeholder="Ingrese el domicilio">{{ $blog->domicilio }}</textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="fechaAlta">Fecha de alta</label>
                                   <input type="date" name="fechaAlta" class="form-control" value="{{ $blog->fechaAlta }}">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                   <label for="vacaciones">Vacaciones</label>
                                   <input type="number" name="vacaciones" class="form-control" value="{{ $blog->vacaciones }}" placeholder="Ingrese los días de vacaciones">
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Guardar</button>                            
                        </div>
                    </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
