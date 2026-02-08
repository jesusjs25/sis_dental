@extends('adminlte::page')

@section('content_header')
    <h1>Actualiazar de un consultorio: {{$consultorio->nombre}}</h1>
    <hr>
@stop

@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Llene los datos del formulario</h3>
                </div>
                    <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{url('admin/consultorios',$consultorio->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Nombre del consultorio</label><b> *</b>
                                <div class="input-group mb-3">
                                
                                    <input type="text" class="form-control" value="{{$consultorio->nombre}}" 
                                    name="nombre" placeholder="Escriba aquí..." required>
                                </div>
                                @error('nombre')
                                    <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Ubicación</label><b> *</b>
                                <div class="input-group mb-3">
                                    
                                    <input type="text" class="form-control" value="{{$consultorio->ubicacion}}" 
                                    name="ubicacion" placeholder="Escriba aquí..." required>
                                </div>
                                @error('ubicacion')
                                    <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Capacidad del Consultorio</label><b> *</b>
                                <div class="input-group mb-3">
                                    
                                    <input type="text" class="form-control" value="{{$consultorio->capacidad}}" 
                                    name="capacidad" placeholder="Escriba aquí..." required>
                                </div>
                                @error('capacidad')
                                    <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Teléfono</label>
                                <div class="input-group mb-3">
                                    
                                    <input type="text" class="form-control" value="{{$consultorio->telefono}}" 
                                    name="telefono" placeholder="Escriba aquí...">
                                </div>
                                @error('telefono')
                                    <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Especialidad del Consultorio</label><b> *</b>
                                <div class="input-group mb-3">
                                    
                                    <input type="text" class="form-control" value="{{$consultorio->especialidad}}" 
                                    name="especialidad" placeholder="Escriba aquí..." required>
                                </div>
                                @error('especialidad')
                                    <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Estado</label>
                                <select name="estado" id="" class="form-control">
                                    @if($consultorio->estado=='ACTIVO')
                                        <option value="ACTIVO">ACTIVO</option>
                                        <option value="INACTIVO">INACTIVO</option>
                                    @else
                                        <option value="ACTIVO">ACTIVO</option>
                                        <option value="INACTIVO">INACTIVO</option>
                                    @endif
                                </select>
                            </div>
                        </div> 
                        </div> 
                        <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="from-group">
                                        <a href="{{url('/admin/consultorios')}}" type="" class="btn btn-default"><i class="fas fa-arrow-left"></i> Cancelar</a>
                                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Actualizar consultorio</button>
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