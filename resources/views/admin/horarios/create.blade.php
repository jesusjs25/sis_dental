@extends('adminlte::page')

@section('content_header')
    <h1>Registro de un nuevo horario</h1>
    <hr>
@stop

@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Llene los datos del formulario</h3>
                </div>
                    <!-- /.card-header -->
                <div class="card-body row">
                    <div class="col-md-3">
                        <form action="{{url('admin/horarios/create')}}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Consultorio</label><b> *</b>
                                    <div class="input-group mb-3">
                                    <select name="consultorio_id" id="consultorio_select" class="form-control">
                                            <option value="">Seleccionar un consultorio</option>
                                            @foreach ($consultorios as $consultorio )
                                                <option value="{{$consultorio->id}}">{{$consultorio->nombre ." - ". $consultorio->ubicacion}}</option>
                                                
                                            @endforeach
                                        </select> 
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Doctores</label>
                                    <div class="input-group mb-3">
                                        <select name="doctor_id" id="" class="form-control">
                                            @foreach ($doctores as $doctor )
                                                <option value="{{$doctor->id}}">{{$doctor->nombres ." ". $doctor->apellidos}}</option>
                                                    
                                            @endforeach
                                        </select>
                                            
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Día</label><b> *</b>
                                <div class="input-group mb-3">
                                    <select name="dia" id="" class="form-control">
                                        <option value="LUNES">LUNES</option>
                                        <option value="MARTES">MARTES</option>
                                        <option value="MIERCOLES">MIÉRCOLES</option>
                                        <option value="JUEVES">JUEVES</option>
                                        <option value="VIERNES">VIERNES</option>
                                        <option value="SABADO">SÁBADO</option>
                                        <option value="DOMINGO">DOMINGO</option>
                                    </select>
                                    
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Hora de Inicio</label><b> *</b>
                                <div class="input-group mb-3">
                                    
                                    <input type="time" class="form-control" value="{{old('hora_inicio')}}" 
                                    name="hora_inicio" placeholder="Escriba aquí..." required>
                                </div>
                                @error('hora_inicio')
                                    <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Hora Final</label><b> *</b>
                                <div class="input-group mb-3">
                                    
                                    <input type="time" class="form-control" value="{{old('hora_fin')}}" 
                                    name="hora_fin" placeholder="Escriba aquí..." required>
                                </div>
                                @error('hora_fin')
                                    <small style="color:red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        </div>
                        <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="from-group">
                                        <a href="{{url('/admin/horarios')}}" type="" class="btn btn-default"><i class="fas fa-arrow-left"></i> Cancelar</a>
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Registrar horario</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                    <div class="col-md-9">
                        <div id="consultorio_info">

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