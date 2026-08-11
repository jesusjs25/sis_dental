@extends('adminlte::page')

@section('content_header')
    <h1>Editar información del usuario: {{$usuario->name}}</h1>
    <hr>
@stop

@section('content')
    
    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Llene los datos del formulario</h3>
                </div>
                    <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{url('/admin/usuarios', $usuario->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nombre del usuario</label><b> *</b>
                                    <div class="input-group mb-3">
                                    
                                        <input type="text" class="form-control" value="{{old('name',$usuario->name)}}" 
                                        name="name" placeholder="Escriba aquí..." required>
                                    </div>
                                    @error('name')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Correo Electrónico</label><b> *</b>
                                    <div class="input-group mb-3">
                                        
                                        <input type="email" class="form-control" value="{{old('email',$usuario->email)}}" 
                                        name="email" placeholder="Escriba aquí..." readonly>
                                    </div>
                                    @error('email')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Contraseña</label>
                                    <div class="input-group mb-3">
                                        
                                        <input type="password" class="form-control" value="" 
                                        name="password" placeholder="Escriba aquí..." >
                                    </div>
                                    @error('password')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Confirmar Contraseña</label>
                                    <div class="input-group mb-3">
                                        
                                        <input type="password" class="form-control" value="" 
                                        name="password_confirmation" placeholder="Escriba aquí...">
                                    </div>
                                    @error('password_confirmation')
                                        <small style="color:red">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="logo">Imagen de usuario</label>
                                        {{-- Mostrar la imagen actual si existe --}}
                                            @if($usuario->logo)
                                                <div class="mb-2">
                                                    <img src="{{ asset('storage/' . $usuario->logo) }}" 
                                                        alt="Imagen de perfil" 
                                                        class="img-thumbnail" 
                                                        style="width: 100px; height: 100px; object-fit: cover;">
                                                </div>
                                            @else
                                                <p class="text-muted small">No tiene imagen cargada</p>
                                            @endif
                                        <input type="file" id="file" name="logo" accept=".jpg, .jpeg, .png" class="form-control">
                                        <br>
                                        <center><output id="list"></output></center>
                                        <script>
                                            function archivo(evt) {
                                                 var files = evt.target.files; //FilesList object
                                                //Obtenemos la imagen del campo "file".
                                                for(var i = 0, f; f = files[i]; i++) {
                                                    //solo admitimos images
                                                    if(!f.type.match('image.*')) {
                                                        continue;
                                                    }
                                                    var reader = new FileReader();
                                                    reader.onload = (function (theFile) {
                                                        return function (e) {
                                                            //insertamos la imagen
                                                            document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="',e.target.result, '" width="70%" title="', escape(theFile.name), '"/>'].join('');

                                                        };
                                                    }) (f);
                                                    reader.readAsDataURL(f);
                                                }
                                            }
                                            document.getElementById('file').addEventListener('change', archivo, false);
                                        </script>
                                    </div>
                                </div>
                            </div> 
                        </div>    
                        <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="from-group">
                                        <a href="{{url('/admin/usuarios')}}" type="" class="btn btn-default"><i class="fas fa-arrow-left"></i> Cancelar</a>
                                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Actualizar datos</button>
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