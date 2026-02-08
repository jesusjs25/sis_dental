@extends('adminlte::page')



@section('content_header')
    <h1><b>Listado de Pacientes</b></h1>
    <hr>
@stop

@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Pacientes registrados</h3>

                            <div class="card-tools">
                                <a href="{{url('/admin/pacientes/create')}}" class="btn btn-primary"> Crear nuevo paciente</a>
                            </div>
                        <!-- /.card-tools -->
                    </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example" class="table table-bordered table-striped table-hover table-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="text-align: center">Nro</th>
                                        <th style="text-align: center">Tipo de Identificación</th>
                                        <th style="text-align: center">Identificación</th>
                                        <th style="text-align: center">Nombres</th>
                                        <th style="text-align: center">Apellidos</th>
                                        <th style="text-align: center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pacientes as $paciente )
                                        <tr>
                                            <td style="text-align: center">{{$loop->iteration}}</td>
                                            <td style="text-align: center">{{$paciente->tipo_identificacion}}</td>
                                            <td style="text-align: center">{{$paciente->identificacion}}</td>
                                            <td style="text-align: center">{{$paciente->nombres}}</td>
                                            <td style="text-align: center">{{$paciente->apellidos}}</td>
                                            <td>
                                                <div class="row d-flex justify-content-center">
                                                    <a href="{{url('/admin/pacientes/'.$paciente->id.'')}}" class="btn btn-info btn-sm" style="margin: 3px">
                                                            <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{url('/admin/pacientes/'.$paciente->id.'/edit')}}" class="btn btn-success btn-sm" style="margin: 3px">
                                                        <i class="fas fa-pencil-alt"></i></a>

                                                    <form action="{{url('/admin/pacientes/'.$paciente->id)}}" method="post" id="miFormulario{{$paciente->id}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="preguntar{{$paciente->id}}(event)" style="margin: 3px">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>

                                                <script>
                                                    function preguntar{{$paciente->id}}(event) {
                                                        event.preventDefault();

                                                        Swal.fire({
                                                            title: '¿Desea eliminar este registro?',
                                                            text: '',
                                                            icon: 'question',
                                                            showDenyButton: true,
                                                            confirmButtonText: 'Eliminar',
                                                            confirmButtonColor: '#a5161d',
                                                            denyButtonColor: '#270a0a',
                                                            denyButtonText: 'Cancelar',
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                // JavaScript puro para enviar el formulario
                                                                document.getElementById('miFormulario{{$paciente->id}}').submit();
                                                            }
                                                        });
                                                    }
                                                </script>
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