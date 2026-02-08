@extends('adminlte::page')

@section('content_header')
    <h1>Información del usuario: {{$usuario->name}}</h1>
    <hr>
@stop

@section('content')
    
    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos registrados</h3>
                </div>
                    <!-- /.card-header -->
                <div class="card-body">
                    
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Nombre del usuario:</label>
                                <p>{{$usuario->name}}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Correo Electrónico:</label>
                                <p>{{$usuario->email}}</p>
                            </div>
                            
                        <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="from-group">
                                        <a href="{{url('/admin/usuarios')}}" type="button" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                                        
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