@extends('adminlte::page')

@section('content_header')
    <h1>Datos del horario</h1>
    <hr>
@stop

@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos registrado</h3>
                </div>
                    <!-- /.card-header -->
                <div class="card-body">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Doctores</label>
                                    <p>{{$horario->doctor->nombres ." ". $horario->doctor->apellidos." - ". $horario->doctor->especialidad}}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Consultorio</label>
                                    <p>{{$horario->consultorio->nombre ." ". $horario->consultorio->ubicacion}}</p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Día</label>
                                <p>{{$horario->dia}}</p>
                                
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Hora de Inicio</label>
                                <p>{{$horario->hora_inicio}}</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Hora Final</label>
                                <p>{{$horario->hora_fin}}</p>
                            </div>
                        </div>
                        </div>
                        <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="from-group">
                                        <a href="{{url('/admin/horarios')}}" type="" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                                        
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