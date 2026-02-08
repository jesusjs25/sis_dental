@extends('adminlte::page')

@section('content_header')
    <h1>Doctor: {{$doctor->nombres ." ". $doctor->apellidos}}</h1>
    <hr>
@stop

@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">¿Estas seguro de eliminar este registro?</h3>
                </div>
                    <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{url('/admin/doctores', $doctor->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Nombre del doctor</label><b> *</b>
                                <p>{{$doctor->nombres}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Apellidos del doctor</label><b> *</b>
                                  <p>{{$doctor->apellidos}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Teléfono</label><b> *</b>
                                
                                <p>{{$doctor->telefono}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Licencia Médica</label>
                                
                                <p>{{$doctor->licencia_medica}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Especialidad del doctor</label><b> *</b>
                                
                                <p>{{$doctor->especialidad}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Correo Electrónico</label><b> *</b>
                                
                                    <p>{{$doctor->user->email}}</p>
                            </div>
                        </div>
                    
                        </div> 
                        <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="from-group">
                                        <a href="{{url('/admin/doctores')}}" type="" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Eliminar doctor</button>
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