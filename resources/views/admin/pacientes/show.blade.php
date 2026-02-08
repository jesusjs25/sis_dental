@extends('adminlte::page')

@section('content_header')
    <h1>Información del paciente</h1>
    <hr>
@stop

@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos registrados</h3>
                </div>
                    <!-- /.card-header -->
                <div class="card-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Tipo de Identificación</label><b>(*)</b>
                                        <p>{{$pacientes->tipo_identificacion}}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Identificación</label><b>(*)</b>
                                        <p>{{$pacientes->identificacion}}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Teléfono</label><b>(*)</b>
                                        <p>{{$pacientes->telefono}}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Nombres del paciente</label><b>(*)</b>
                                            <p>{{$pacientes->nombres}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Fecha de Nacimiento</label><b>(*)</b>
                                            <p>{{$pacientes->f_nacimiento}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Edad</label><b>(*)</b>
                                            <p>{{$pacientes->edad}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                   <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Apellidos del paciente</label><b>(*)</b>
                                            <p>{{$pacientes->apellidos}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Correo Electrónico</label><b>(*)</b>
                                            <p>{{$pacientes->correo_electronico}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Dirección</label><b>(*)</b>
                                            <p>{{$pacientes->direccion}}</p>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                            </div>
                        </div>
                        <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="from-group">
                                        <a href="{{url('/admin/pacientes')}}" type="" class="btn btn-default"><i class="fas fa-arrow-left"></i> Volver</a>
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