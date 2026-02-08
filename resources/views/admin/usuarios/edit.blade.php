@extends('adminlte::page')

@section('content_header')
    <h1>Editar información del usuario: {{$usuario->name}}</h1>
    <hr>
@stop

@section('content')
    
    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Llene los datos del formulario</h3>
                </div>
                    <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{url('/admin/usuarios', $usuario->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Nombre del usuario</label><b> *</b>
                                <div class="input-group mb-3">
                                
                                    <input type="text" class="form-control" value="{{old('name',$usuario->name)}}" 
                                    name="name" placeholder="Escriba aquí..." required>
                                </div>
                                @error('name')
                                    <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Correo Electrónico</label><b> *</b>
                                <div class="input-group mb-3">
                                    
                                    <input type="email" class="form-control" value="{{old('email',$usuario->email)}}" 
                                    name="email" placeholder="Escriba aquí..." required>
                                </div>
                                @error('email')
                                    <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Contraseña</label>
                                <div class="input-group mb-3">
                                    
                                    <input type="password" class="form-control" value="" 
                                    name="password" placeholder="Escriba aquí..." >
                                </div>
                                @error('password')
                                    <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Confirmar Contraseña</label>
                                <div class="input-group mb-3">
                                    
                                    <input type="password" class="form-control" value="" 
                                    name="password_confirmation" placeholder="Escriba aquí...">
                                </div>
                                @error('password_confirmation')
                                    <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div> 
                            
                        <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="from-group">
                                        <a href="{{url('/admin/usuarios')}}" type="" class="btn btn-default"><i class="fas fa-arrow-left"></i> Cancelar</a>
                                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Actualizar datos</button>
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