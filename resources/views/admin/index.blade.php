@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1><b>Bienvenido:</b> {{Auth::user()->email}} / Rol: {{Auth::user()->roles->pluck('name')->first()}}</h1>
@stop

@section('content')
  <hr>
   
  <div class="row">

     @can('admin.usuarios.index')
        <div class="col-lg-3 col-6">
            <!-- small box -->
          <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$total_usuarios}}</h3>

                <p>Usuarios</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag fas fa-user"></i>
              </div>
                <a href="{{url('/admin/usuarios')}}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
     @endcan

     @can('admin.pacientes.index')

        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>{{$total_pacientes}}</h3>

              <p>Pacientes</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag fas fa-users"></i>
            </div>
              <a href="{{url('/admin/pacientes')}}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
          </div>
     </div>
      @endcan
      @can('admin.consultorios.index')
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{$total_consultorios}}</h3>

              <p>Consultorio</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag fas fa-building"></i>
            </div>
              <a href="{{url('/admin/consultorios')}}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
          </div>
     </div>
      @endcan
      @can('admin.doctores.index')
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{$total_doctores}}</h3>

              <p>Doctores</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag fas fa-user-md"></i>
            </div>
              <a href="{{url('/admin/doctores')}}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
          </div>
     </div>
      @endcan
      @can('admin.horarios.index')
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{$total_horarios}}</h3>

              <p>Horarios</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag fas fa-clock"></i>
            </div>
              <a href="{{url('/admin/horarios')}}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
          </div>
      </div>
      @endcan
  </div>

  <div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Reserva de Cita Médica</h3>
    </div>
    <div class="card-body">
        <div id="msj_validacion"></div> <form id="form_reserva_rapida">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Documento de Identidad</label>
                        <input type="text" id="identificacion" class="form-control" placeholder="Cédula o Pasaporte" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Fecha deseada</label>
                        <input type="date" id="fecha_reserva" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Hora</label>
                        <input type="time" id="hora_reserva" class="form-control" required>
                    </div>
                </div>
            </div>
            <button type="button" id="btn_verificar_reserva" class="btn btn-primary btn-block">
                Verificar Disponibilidad y Reservar
            </button>
        </form>
    </div>
</div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                          <h3 class="card-title">Calendario de reservas de citas</h3>
                        </div>
                      </div>
                  </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!--<div class="row">
                        
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                          Reservar cita
                        </button>

                        
                        <form action="{{url('/admin/eventos/create')}}" method="POST">
                          @csrf
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Registar cita</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                      <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <label for="">Doctor</label>
                                                  <select name="doctor_id" id=""class="form-control">
                                                    <option value="">Seleccionar un Doctor</option>
                                                    @foreach ($doctores as $doctor)
                                                      <option value="{{$doctor->id}}">{{$doctor->nombres ." ". $doctor->apellidos
                                                        ." ".$doctor->especialidad}}</option>
                                                    @endforeach
                                                  </select>
                                              </div>
                                          </div>
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                <label for="">Fecha de reserva</label>
                                                <input type="date" id="fecha_reserva" value="<?php echo date('Y-m-d');?>" name="fecha_reserva" class="form-control" >
                                              </div>
                                          </div>
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                  <label for="">Hora de reserva</label>
                                                  <input type="time" id="hora_reserva" name="hora_reserva" class="form-control" >
                                                  @error('hora_reserva')
                                                      <small style="color:red">{{$message}}</small>
                                                  @enderror
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Registar cita</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </form>
                    </div>-->
                    <div id='calendar'></div>
                </div>
                  <!-- /.card-body -->
            <div>
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
    {{--script calendar--}}
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.20/index.global.min.js'></script>
    <script src="{{url('fullcalendar/es.global.js')}}"></script>
    <script>

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          locale:'es',
          events:[
            @foreach ($eventos as $evento)

            {
              title: '{{$evento->title}}',
              start: '{{\Carbon\Carbon::parse($evento->start)->format('Y-m-d')}}',
              end: '{{\Carbon\Carbon::parse($evento->end)->format('Y-m-d')}}',
              color:'green'
            },
              
            @endforeach
            
          ]
        });
        calendar.render();
      });

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fechaReservaInput = document.getElementById('fecha_reserva');

            //escuchar el evento de cambio en el campo de fecha de reserva
            fechaReservaInput.addEventListener('change', function() {
              let selecteDate = this.value;  //obtener la fecha seleccionada

              //obtener la fecha actual en formato ISO (YYY-MM-DD)
              let today = new Date().toISOString().slice(0,10);

              //verificar si la fecha seleccionada es anterior a la fecha actual
              if(selecteDate < today) {
                //si es asi, establecer la fecha seleccionada en el nul
                this.value = null;
                alert('No se puede reservar en  una fecha pasada');
              }

            });

        });
    </script>

    @if( (($mensaje = Session::get('hora_reserva'))) )
        <script>
          $(document).ready(function() {
            $('#exampleModal').modal('show');
          });
        </script>
          <small style="color:red">{{$mensaje}}</small>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const horaReservaInput = document.getElementById('hora_reserva');

            
            horaReservaInput.addEventListener('change', function() {
              let selecteTime = this.value;  //obtener el valor la hora seleccionada

              //asegurarque solo se capture la parte de la hora
              if(selecteTime) {
                selecteTime = selecteTime.split(':');//dividir la cadena en hora y minutos
                selecteTime = selecteTime[0] + ':00';//conservar solo la hora, ignorar los minutos
                this.value = selecteTime; //establecer la hora modificada en el campo de la entrada 
              }

              //verificar si la hora selecccionada esta fuera del rango permitido
              if(selecteTime < '08:00' || selecteTime > '20:00') {
                //si es asi, establecer la hora seleccionada en null
                this.value = null;
                alert('Por favor, seleccionar una hora entre 08:00 am hasta 20:00 pm')
              }
            });
        });
    </script>

    
    <script>//verificar para reserva citas
        $('#btn_verificar_reserva').click(function() {
    let datos = {
        identificacion: $('#identificacion').val(),
        fecha_reserva: $('#fecha_reserva').val(),
        hora_reserva: $('#hora_reserva').val(),
        "_token": "{{ csrf_token() }}"
    };

    $.ajax({
        url: "{{ route('admin.eventos.verificar') }}",
        method: "POST",
        data: datos,
        success: function(res) {
            if (res.status === 'success') {
                Swal.fire({
                    title: '¡Reservado!',
                    text: res.mensaje,
                    icon: 'success',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    // Recargar la página para que el calendario muestre la nueva cita
                    location.reload(); 
                    // O si usas FullCalendar: $('#calendar').fullCalendar('refetchEvents');
                });
            } else if (res.status === 'error_paciente') {
                Swal.fire({
                    title: 'No registrado',
                    html: `${res.mensaje} <br><br> <a href="${res.link}" class="btn btn-primary">Registrarse ahora</a>`,
                    icon: 'warning'
                });
            } else {
                Swal.fire('Atención', res.mensaje, 'error');
            }
        }
    });
});
</script>
@stop
