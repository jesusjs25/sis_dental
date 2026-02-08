@extends('adminlte::page')

@section('content_header')
    <h1>Información del consultorio: {{$consultorio->nombre}}</h1>
    <hr>
@stop

@section('content')
    
    <div class="row">
        <div class="col-md-10">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos registrados</h3>
                </div>
                    <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Nombre del consultorio:</label>
                                <p>{{$consultorio->nombre}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Ubicación:</label>
                                <p>{{$consultorio->ubicacion}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Capacidad:</label>
                                <p>{{$consultorio->capacidad}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Teléfono:</label>
                                <p>{{$consultorio->telefono}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Especialidad:</label>
                                <p>{{$consultorio->especialidad}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Estado:</label>
                                <p>{{$consultorio->estado}}</p>
                            </div>
                        </div>
                    </div>
                
                    <hr>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="from-group">
                                    <a href="{{url('/admin/consultorios')}}" type="button" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                                        
                                </div>
                            </div>
                        </div>
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