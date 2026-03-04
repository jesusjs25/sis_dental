@extends('adminlte::page')

@section('title', 'Historial del Paciente')

@section('content_header')
    <h1>Expediente: </h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Columna de Datos del Paciente -->
        <div class="col-md-4">
            <!-- Datos Básicos -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <i class="fas fa-user-circle fa-5x text-secondary"></i>
                    </div>
                    <h3 class="profile-username text-center"></h3>
                    <p class="text-muted text-center">Paciente Registrado</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Teléfono:</b> <a class="float-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>F. Nacimiento:</b> <a class="float-right"></a>
                        </li>
                    </ul>

                    <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-cita">
                        <i class="fas fa-plus mr-1"></i> Nueva Consulta
                    </button>
                </div>
            </div>

            <!-- Antecedentes y Observaciones -->
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Observaciones Dentales</h3>
                </div>
                <div class="card-body">
                    <strong><i class="fas fa-notes-medical mr-1"></i> Médicas</strong>
                    <p class="text-muted"></p>
                    <hr>
                    <strong><i class="fas fa-tooth mr-1"></i> Dentales</strong>
                    <p class="text-muted"></p>
                </div>
            </div>
        </div>

        <!-- Columna del Historial (Timeline) -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Línea de Tiempo</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="timeline">
                            <div class="timeline timeline-inverse">
                                
                                    <!-- Fecha del tratamiento -->
                                    <div class="time-label">
                                        <span class="bg-info">
                                            
                                        </span>
                                    </div>
                                    <!-- Detalle del tratamiento -->
                                    <div>
                                        <i class="fas fa-stethoscope bg-primary"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> Costo: </span>
                                            <h3 class="timeline-header"><b>Motivo:</b></h3>
                                            <div class="timeline-body">
                                                
                                                
                                                
                                                    <div class="mt-2">
                                                        <a href="#" target="_blank" class="btn btn-xs btn-outline-secondary">
                                                            <i class="fas fa-image"></i> Ver Radiografía/Archivo
                                                        </a>
                                                    </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="p-4 text-center">
                                        <p class="text-muted">No hay visitas registradas aún.</p>
                                    </div>
                                
                                <div>
                                    <i class="far fa-clock bg-gray"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Nueva Consulta -->
<div class="modal fade" id="modal-cita">
    <div class="modal-dialog">
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Registrar Nueva Consulta</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Fecha</label>
                        <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Motivo</label>
                        <input type="text" name="reason" class="form-control" placeholder="Ej: Dolor en muela superior" required>
                    </div>
                    <div class="form-group">
                        <label>Tratamiento Realizado</label>
                        <textarea name="treatment_done" class="form-control" rows="3" placeholder="Describe el procedimiento..." required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Costo ($)</label>
                                <input type="number" name="cost" class="form-control" step="0.01" value="0.00">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Adjuntar Foto/Rayos X</label>
                                <input type="file" name="attachment" class="form-control-file">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Tratamiento</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

@section('css')
    <style>
        .timeline-inverse > div > .timeline-item {
            box-shadow: 0 0 1px rgba(0,0,0,.125),0 1px 3px rgba(0,0,0,.2);
            margin-bottom: 15px;
        }
    </style>
@stop