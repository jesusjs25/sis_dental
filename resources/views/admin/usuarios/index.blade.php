@extends('adminlte::page')



@section('content_header')
    <h1><b>Listado de Usuarios</b></h1>
    <hr>
@stop

@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Usuarios registrados</h3>

                            <div class="card-tools">
                                <a href="{{url('/admin/usuarios/create')}}" class="btn btn-primary"> Crear nuevo usuario</a>
                            </div>
                        <!-- /.card-tools -->
                    </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example" class="table table-bordered table-striped table-hover table-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="text-align: center">Nro</th>
                                        <th style="text-align: center">Nombre</th>
                                        <th style="text-align: center">Correo electrónico</th>
                                        <th style="text-align: center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usuarios as $user )
                                        <tr>
                                            <td style="text-align: center">{{$loop->iteration}}</td>
                                            <td style="text-align: center">{{$user->name}}</td>
                                            <td style="text-align: center">{{$user->email}}</td>
                        
                                            <td>
                                                <div class="row d-flex justify-content-center">
                                                    <a href="{{url('/admin/usuarios/'.$user->id.'')}}" type="button" class="btn btn-info btn-sm" style="margin: 3px">
                                                            <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{url('/admin/usuarios/'.$user->id.'/edit')}}" type="button" class="btn btn-success btn-sm" style="margin: 3px">
                                                        <i class="fas fa-pencil-alt"></i></a>

                                                    <a href="{{url('/admin/usuarios/'.$user->id.'/confirm-delete')}}" type="button" class="btn btn-danger btn-sm" style="margin: 3px">
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