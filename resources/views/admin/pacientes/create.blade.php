@extends('adminlte::page')

@section('content_header')
    <h1>Creación de un nuevo paciente</h1>
    <hr>
@stop

@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Llene los datos del formulario</h3>
                </div>
                    <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{url('admin/pacientes/create')}}" method="POST">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Tipo de Identificación</label><b>(*)</b>
                                        <div class="input-group mb-3">
                                            
                                            <select name="tipo_identificacion" id="tipo_identificacion" class="form-control" required>
                                                        <option value="">Seleccione una opción</option>
                                                        
                                                        <option value="V">
                                                            <p>V</p>
                                                        </option>
                                                        <option value="E">
                                                            <p>E</p>
                                                        </option>
                                                        
                                            </select>
                                        </div>
                                        @error('tipo_identificacion')
                                            <small style="color:red">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Identificación</label><b>(*)</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                                            </div>
                                            <input type="text" class="form-control" value="{{old('identificacion')}}" 
                                                name="identificacion" placeholder="Escriba aquí..." required>
                                        </div>
                                        @error('identificacion')
                                            <small style="color:red">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Teléfono</label><b>(*)</b>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" value="{{old('telefono')}}" 
                                                name="telefono" placeholder="Escriba aquí..." required>
                                        </div>
                                        @error('telefono')
                                            <small style="color:red">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nombres del paciente</label><b>(*)</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                </div>
                                                <input type="text" class="form-control" value="{{old('nombres')}}" 
                                                    name="nombres" placeholder="Escriba aquí..." required>
                                            </div>
                                            @error('nombres')
                                                <small style="color:red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Fecha de Nacimiento</label><b>(*)</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                </div>
                                                <input type="date" class="form-control" value="{{old('f_nacimiento')}}" 
                                                    name="f_nacimiento" id="f_nacimiento" placeholder="Escriba aquí..." required>
                                            </div>
                                            @error('f_nacimiento')
                                                <small style="color:red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Edad</label><b>(*)</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                </div>
                                                <input type="text" class="form-control" value="{{old('edad')}}" 
                                                    name="edad" id="edad" readonly>
                                            </div>
                                            @error('edad')
                                                <small style="color:red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                   <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Apellidos del paciente</label><b>(*)</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                </div>
                                                <input type="text" class="form-control" value="{{old('apellidos')}}" 
                                                    name="apellidos" placeholder="Escriba aquí..." required>
                                            </div>
                                            @error('apellidos')
                                                <small style="color:red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Correo Electrónico</label><b>(*)</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                </div>
                                                <input type="text" class="form-control" value="{{old('correo_electronico')}}" 
                                                    name="correo_electronico" placeholder="Escriba aquí..." required>
                                            </div>
                                            @error('correo_electronico')
                                                <small style="color:red">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Dirección</label><b>(*)</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-compass"></i></span>
                                                </div>
                                                <input type="text" class="form-control" value="{{old('direccion')}}" 
                                                    name="direccion" placeholder="Escriba aquí..." required>
                                            </div>
                                            @error('direccion')
                                                <small style="color:red">{{$message}}</small>
                                            @enderror
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
                                        <a href="{{url('/admin/pacientes')}}" type="" class="btn btn-default"><i class="fas fa-arrow-left"></i> Cancelar</a>
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
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
    <script>
    document.getElementById('f_nacimiento').addEventListener('change', function() {
    var fechaNacimiento = new Date(this.value);
    var hoy = new Date();
    
    // Calcular la diferencia en años
    var edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
    var m = hoy.getMonth() - fechaNacimiento.getMonth();
    
    // Ajustar si el mes actual es anterior al mes de nacimiento 
    // o si es el mismo mes pero el día actual es anterior
    if (m < 0 || (m === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
        edad--;
    }
    
    // Asignar el valor al campo edad
    document.getElementById('edad').value = edad;
});
</script>
@stop