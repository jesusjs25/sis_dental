{{-- pagos/create.blade.php --}}
@extends('adminlte::page')

@section('content_header')
    <h1>Registrar Pago de Consulta</h1>
@stop

@section('content')

{{-- pagos/index.blade.php --}}
<table class="table table-hover">
    <thead>
        <tr>
            <th>Paciente</th>
            <th>Referencia</th>
            <th>Monto ($)</th>
            <th>Monto (Bs)</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pagos as $pago)
        <tr>
            <td>{{ $pago->user->name }}</td>
            <td>{{ $pago->referencia }}</td>
            <td>${{ number_format($pago->monto_usd, 2) }}</td>
            <td>{{ number_format($pago->monto_bs, 2) }} Bs.</td>
            <td>
                <span class="badge {{ $pago->status == 'pendiente' ? 'badge-warning' : 'badge-success' }}">
                    {{ ucfirst($pago->status) }}
                </span>
            </td>
            <td>
                @if($pago->status == 'pendiente')
                    <form action="{{ route('admin.pagos.aprobar', $pago->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-success">Aprobar Pago</button>
                    </form>
                @else
                    <a href="{{ route('admin.pagos.factura', $pago->id) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-file-pdf"></i> Factura
                    </a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="row">
    <div class="col-md-7">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Detalles de la Transacción</h3>
            </div>
            <form action="{{ route('admin.pagos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Método de Pago</label>
                            <select name="metodo" class="form-control" required>
                                <option value="pago_movil">Pago Móvil</option>
                                <option value="transferencia">Transferencia (BDV)</option>
                                <option value="biopago">BDV Biopago</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Referencia (Últimos 4-6 dígitos)</label>
                            <input type="text" name="referencia" class="form-control" placeholder="001234" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Monto en Dólares ($)</label>
                            <input type="number" step="0.01" id="monto_usd" name="monto_usd" class="form-control" placeholder="35.00">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Monto en Bolívares (Bs)</label>
                            <input type="number" step="0.01" id="monto_bs" name="monto_bs" class="form-control" placeholder="Calculado al BCV">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Subir Comprobante (Opcional)</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="comprobante" class="custom-file-input">
                                <label class="custom-file-label">Elegir archivo</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success">Registrar Pago</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-5">
        <div class="info-box bg-light border">
            <span class="info-box-icon bg-info"><i class="fas fa-university"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Datos OdonCare (BDV)</span>
                <span class="info-box-number text-sm">RIF: J-12345678-9</span>
                <span class="info-box-text text-sm">0102-XXXX-XX-XXXXXXXXXX</span>
                <span class="info-box-text text-xs text-muted">Pago Móvil: 0412-0000000</span>
            </div>
        </div>
        
        <div class="alert alert-info">
            <h5><i class="icon fas fa-info"></i> Tasa del Día (BCV)</h5>
            Hoy: <strong>36.50 Bs/$</strong> 
            <small class="d-block">El sistema calcula automáticamente el cambio.</small>
        </div>
    </div>
</div>
@stop