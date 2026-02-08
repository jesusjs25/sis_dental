@extends('adminlte::page')

@section('content_header')
    <h1>Usuario: {{$usuario->name}}</h1>
    <hr>
@stop

@section('content')
    
    <div class="row">
        <div class="col-md-6">
            <div class="card  card-danger">
                <div class="card-header">
                    <h3 class="card-title">¿Esta seguro de eliminar este usuario?</h3>
                </div>
                    <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{url('/admin/usuarios', $usuario->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Nombre del usuario</label>
                                <div class="input-group mb-3">
                                
                                    <input type="text" class="form-control" value="{{$usuario->name}}" 
                                    name="name" placeholder="Escriba aquí..." disabled>
                                </div>
                                @error('name')
                                    <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Correo Electrónico</label><b> *</b>
                                <div class="input-group mb-3">
                                    
                                    <input type="email" class="form-control" value="{{$usuario->email}}" 
                                    name="email" placeholder="Escriba aquí..." disabled>
                                </div>
                                @error('email')
                                    <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div> 
                            
                        <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="from-group">
                                        <a href="{{url('/admin/usuarios')}}" type="" class="btn btn-default"><i class="fas fa-arrow-left"></i> Cancelar</a>
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Eliminar usuario</button>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    
@stop