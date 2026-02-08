@extends('adminlte::page')

@section('content_header')
    <h1>Registro de un nuevo doctor</h1>
    <hr>
@stop

@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Llene los datos del formulario</h3>
                </div>
                    <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{url('admin/doctores/create')}}" method="POST">
                        @csrf
                        <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Nombre del doctor</label><b> *</b>
                                <div class="input-group mb-3">
                                
                                    <input type="text" class="form-control" value="{{old('nombres')}}" 
                                    name="nombres" placeholder="Escriba aquí..." required>
                                </div>
                                @error('nombres')
                                    <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Apellidos del doctor</label><b> *</b>
                                <div class="input-group mb-3">
                                    
                                    <input type="text" class="form-control" value="{{old('apellidos')}}" 
                                    name="apellidos" placeholder="Escriba aquí..." required>
                                </div>
                                @error('apellidos')
                                    <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Teléfono</label><b> *</b>
                                <div class="input-group mb-3">
                                    
                                    <input type="number" class="form-control" value="{{old('telefono')}}" 
                                    name="telefono" placeholder="Escriba aquí..." required>
                                </div>
                                @error('telefono')
                                    <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Licencia Médica</label>
                                <div class="input-group mb-3">
                                    
                                    <input type="text" class="form-control" value="{{old('licencia_medica')}}" 
                                    name="licencia_medica" placeholder="Escriba aquí...">
                                </div>
                                @error('licencia_medica')
                                    <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Especialidad del doctor</label><b> *</b>
                                <div class="input-group mb-3">
                                    
                                    <input type="text" class="form-control" value="{{old('especialidad')}}" 
                                    name="especialidad" placeholder="Escriba aquí..." required>
                                </div>
                                @error('especialidad')
                                    <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Correo Electrónico</label><b> *</b>
                                <div class="input-group mb-3">
                                    
                                    <input type="email" class="form-control" value="{{old('email')}}" 
                                    name="email" placeholder="Escriba aquí..." required>
                                </div>
                                @error('email')
                                    <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Contraseña</label><b> *</b>
                                <div class="input-group mb-3">
                                    
                                    <input type="password" class="form-control" value="" 
                                    name="password" placeholder="Escriba aquí..." required>
                                </div>
                                @error('password')
                                    <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Confirmar Contraseña</label><b> *</b>
                                <div class="input-group mb-3">
                                    
                                    <input type="password" class="form-control" value="" 
                                    name="password_confirmation" placeholder="Escriba aquí..." required>
                                </div>
                                @error('password_confirmation')
                                    <small style="color:red">{{$message}}</small>
                                @enderror
                            </div> 
                        </div>
                        </div> 
                        <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="from-group">
                                        <a href="{{url('/admin/consultorios')}}" type="" class="btn btn-default"><i class="fas fa-arrow-left"></i> Cancelar</a>
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Registrar doctor</button>
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