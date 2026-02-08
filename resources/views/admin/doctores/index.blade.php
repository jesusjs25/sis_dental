@extends('adminlte::page')



@section('content_header')
    <h1><b>Listado de Doctores</b></h1>
    <hr>
@stop

@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Doctores registrados</h3>

                            <div class="card-tools">
                                <a href="{{url('/admin/doctores/create')}}" class="btn btn-primary"> Crear nuevo doctor</a>
                            </div>
                        <!-- /.card-tools -->
                    </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example" class="table table-bordered table-striped table-hover table-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="text-align: center">Nro</th>
                                        <th style="text-align: center">Nombres y Apellidos</th>
                                        <th style="text-align: center">Teléfono</th>
                                        <th style="text-align: center">Licencia Medica</th>
                                        <th style="text-align: center">Especialidad</th>
                                        <th style="text-align: center">Email</th>
                                        <th style="text-align: center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($doctores as $doctors )
                                        <tr>
                                            <td style="text-align: center">{{$loop->iteration}}</td>
                                            <td style="text-align: center">{{$doctors->nombres ." ".$doctors->apellidos}}</td>
                                            <td style="text-align: center">{{$doctors->telefono}}</td>
                                            <td style="text-align: center">{{$doctors->licencia_medica}}</td>
                                            <td style="text-align: center">{{$doctors->especialidad}}</td>
                                            <td style="text-align: center">{{$doctors->user->email}}</td>
                                            
                        
                                            <td>
                                                <div class="row d-flex justify-content-center">
                                                    <a href="{{url('/admin/doctores/'.$doctors->id.'')}}" type="button" class="btn btn-info btn-sm" style="margin: 3px">
                                                            <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{url('/admin/doctores/'.$doctors->id.'/edit')}}" type="button" class="btn btn-success btn-sm" style="margin: 3px">
                                                        <i class="fas fa-pencil-alt"></i></a>

                                                    <a href="{{url('/admin/doctores/'.$doctors->id.'/confirm-delete')}}" type="button" class="btn btn-danger btn-sm" style="margin: 3px">
                                                        <i class="fas fa-trash"></i></a>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
              <!-- /.card-body -->
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    
@stop

@section('js')

@stop