@extends('adminlte::page')



@section('content_header')
    <h1><b>Listado de Horarios</b></h1>
    <hr>
@stop

@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Horarios registrados</h3>

                            <div class="card-tools">
                                <a href="{{url('/admin/horarios/create')}}" class="btn btn-primary"> Crear nuevo horario</a>
                            </div>
                        <!-- /.card-tools -->
                    </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example" class="table table-bordered table-striped table-hover table-sm">
                                <thead class="table-dark">
                                    <trstyle="text-align: center>
                                        <th>Nro</th>
                                        <th>Doctor</th>
                                        <th>Especialidad</th>
                                        <th>Consultorio</th>
                                        <th>Día de atención</th>
                                        <th>Hora Inicio</th>
                                        <th>Hora final</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($horarios as $horario )
                                        <tr style="text-align: center">
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$horario->doctor->nombres ." ". $horario->doctor->apellidos}}</td>
                                            <td>{{$horario->doctor->especialidad}}</td>
                                            <td>{{$horario->consultorio->nombre}}</td>
                                            <td>{{$horario->dia}}</td>
                                            <td>{{$horario->hora_inicio}}</td>
                                            <td>{{$horario->hora_fin}}</td>
                    
                                            <td>
                                                <div class="row d-flex justify-content-center">
                                                    <a href="{{url('/admin/horarios/'.$horario->id.'')}}" type="button" class="btn btn-info btn-sm" style="margin: 3px">
                                                            <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{url('/admin/horarios/'.$horario->id.'/edit')}}" type="button" class="btn btn-success btn-sm" style="margin: 3px">
                                                        <i class="fas fa-pencil-alt"></i></a>

                                                    <a href="{{url('/admin/horarios/'.$horario->id.'/confirm-delete')}}" type="button" class="btn btn-danger btn-sm" style="margin: 3px">
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
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4">
                                <h3 class="card-title">Calendario de atención de doctores</h3>
                            </div>
                            <div class="col-md-4">
                                <div style="float:right">
                                    <label for="">Consultorio:</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <select name="consultorio_id" id="consultorio_select" class="form-control">
                                    <option value="">Seleccionar un consultorio</option>
                                    @foreach ($consultorios as $consultorio )
                                        <option value="{{$consultorio->id}}">{{$consultorio->nombre ." - ". $consultorio->ubicacion}}</option>
                                                    
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            
                            <hr>
                            <div id="consultorio_info">

                            </div>
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
    <script>
        $('#consultorio_select').on('change',function() {
            var consultorio_id = $('#consultorio_select').val();
                //alert('hola');
                var url = "{{route('admin.horarios.cargar_datos_consultorios',':id')}}";
                url = url.replace(':id',consultorio_id);
            if(consultorio_id) {
                $.ajax({
                    url: url,
                    type:'GET',
                    success:function(data) {
                        $('#consultorio_info').html(data);

                    },
                    error:function() {
                        alert('Error al obtener los datos del consultorio')
                    }
                });
            }else {
                $('#consultorio_info').html('');
            }
        });
    </script>
@stop