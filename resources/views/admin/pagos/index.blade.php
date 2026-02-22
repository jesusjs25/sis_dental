@extends('adminlte::page')

@section('title', 'Pagos Odoncere')

@section('content_header')
    <h1>Registro de Pagos - Odoncere</h1>
@stop

@section('content')
<div class="row">
    <div class="card card-outline card-info col-md-12">
    <div class="card-body">
        <form action="{{ route('admin.pagos.tasa') }}" method="POST" class="form-inline">
            @csrf
            <label class="mr-2">Tasa del Día (BCV):</label>
            <input type="number" step="0.01" name="tasa_dia" value="{{ $tasa_actual }}" class="form-control mr-2" style="width: 150px;">
            <button type="submit" class="btn btn-info">Fijar Tasa</button>
        </form>
    </div>
</div>
</div>
<div class="row">
    <div class="col-md-5">
        <div class="card card-primary">
            <div class="card-header"><h3 class="card-title">Nueva Transacción</h3></div>
            <form action="{{ route('admin.pagos.store') }}" method="POST">
                @csrf
                <input type="hidden" name="tasa_dia" id="tasa" value="{{ $tasa_actual }}">
                <div class="card-body">
                    <div class="form-group">
                        <div class="alert alert-secondary">
                            Tasa actual: <strong>{{ number_format($tasa_actual, 2) }} Bs.</strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label>Cédula</label>
                            <input type="text" name="identificacion" id="identificacion" class="form-control" required onblur="buscarPaciente()">
                        </div>
                        <div class="col-6">
                            <label>Nombre del Paciente</label>
                            <input type="text" name="nombres" id="nombres" class="form-control" required>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group mt-3">
                        <label>Monto del Tratamiento ($)</label>
                        <input type="number" step="0.01" name="monto_usd" id="monto_usd" class="form-control" required oninput="calcular()">
                    </div>
                    <div class="form-group">
                        <label>Monto Recibido ($) <small>(Para calcular vuelto)</small></label>
                        <input type="number" step="0.01" name="recibido_usd" id="recibido_usd" class="form-control" oninput="calcular()">
                    </div>
                    
                    <div class="alert alert-info">
                        <strong>Total en Bs: </strong> <span id="total_bs">0.00</span> Bs.<br>
                        <strong>Vuelto: </strong> <span id="vuelto_text">0.00</span> $
                    </div>

                    <div class="form-group">
                        <label>Método de Pago</label>
                        <select name="metodo_pago" class="form-control">
                            <option>Transferencia</option>
                            <option>Pago Móvil</option>
                            <option>BDV Bio Pago</option>
                            <option>Efectivo $</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Número de Operación / Referencia</label>
                        <input type="text" name="numero_operacion" class="form-control" placeholder="Ej: 123456">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-block">Registrar Pago</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-7">
        <div class="card">
            <div class="card-header"><h3 class="card-title">Últimos Pagos Registrados</h3></div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Paciente</th>
                            <th>Monto $</th>
                            <th>Ref / Operación</th> <th>Método</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pagos as $pago)
                        <tr>
                            <td>{{ $pago->paciente->nombres }}</td> 
                            <td>${{ number_format($pago->monto_usd, 2) }}</td>
                            <td><code>{{ $pago->numero_operacion ?? 'N/A' }}</code></td> <td><span class="badge badge-info">{{ $pago->metodo_pago }}</span></td>
                            <td>{{ $pago->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
<script>
function buscarPaciente() {
    let identificacion = $('#identificacion').val();
    
    if(identificacion.length > 4) {
        $.get("{{ route('admin.pagos.buscar') }}", {identificacion: identificacion}, function(data) {
            if(data.exists) {
                $('#nombres').val(data.nombres);
                toastr.success('Paciente encontrado');
            } else {
                $('#nombres').val(''); // Limpiamos el campo
                
                Swal.fire({
                    title: '¡Paciente no registrado!',
                    text: "La cédula " + identificacion + " no existe en el sistema Odoncere.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '<i class="fas fa-user-plus"></i> Registrar ahora',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirige a tu ruta de creación de pacientes
                        window.location.href = "{{ url('admin/pacientes/create') }}?cedula=" + identificacion;
                    }
                });
            }
        });
    }
}

function calcular() {
    let tasa = parseFloat($('#tasa').val()) || 0;
    let usd = parseFloat($('#monto_usd').val()) || 0;
    let recibido = parseFloat($('#recibido_usd').val()) || 0;

    let totalBs = tasa * usd;
    $('#total_bs').text(totalBs.toLocaleString('es-VE', {minimumFractionDigits: 2}));

    let vuelto = recibido - usd;
    $('#vuelto_text').text(vuelto > 0 ? vuelto.toFixed(2) : "0.00");
}
</script>
@stop