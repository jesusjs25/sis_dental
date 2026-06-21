@extends('adminlte::page')



@section('content_header')
    <h1><b>Listado de reservas</b></h1>
    <hr>
@stop

@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Reservas registradas</h3>
                        <!-- /.card-tools -->
                    </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example" class="table table-bordered table-striped table-hover table-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th style="text-align: center">Nro</th>
                                        <th style="text-align: center">Doctor</th>
                                        <th style="text-align: center">Especialidad</th>
                                        <th style="text-align: center">Fecha de reserva</th>
                                        <th style="text-align: center">Hora de reserva</th>
                                        <th style="text-align: center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($eventos as $evento )
                                        <tr>
                                            <td style="text-align: center">{{$loop->iteration}}</td>
                                            <td style="text-align: center">{{$evento->doctor->nombres." ".$evento->doctor->apellidos}}</td>
                                            <td style="text-align: center">{{$evento->doctor->especialidad}}</td>
                                            <td style="text-align: center">{{\Carbon\Carbon::parse($evento->start)->format('d/m/Y')}}</td>
                                            <td style="text-align: center">{{\Carbon\Carbon::parse($evento->end)->format('H:i')}}</td>
                                            
                        
                                            <td>
                                                <div class="row d-flex justify-content-center">


                                                <form action="{{url('/admin/eventos/destroy',$evento->id)}}" id="formulario{{$evento->id}}" 
                                                onsubmit="confirmDelete(event, {{$evento->id}})" method="POST" style="display: inline-block">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger btn-sm" style="margin: 3px">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>

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

        <script>
            function confirmDelete(event, id){
                event.preventDefault();
                Swal.fire({
                    title: "¿Está seguro que desea eliminar esta reserva?",
                    text: "si elimina esta reserva, no podrá recuperarla",
                    icon: "warning",
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: "Eliminar",
                    denyButtonText: `Cancelar`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire("Eliminado!", "", "success");
                        var form = document.getElementById("formulario" + id);
                        if (form) {
                            form.submit();
                        }
                    }
                });
            }
        </script>
@stop