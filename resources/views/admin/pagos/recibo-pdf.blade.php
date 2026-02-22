<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recibo Odoncere #{{ $pago->id }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 14px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #007bff; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { margin: 0; color: #007bff; }
        .section { margin-bottom: 15px; }
        .label { font-weight: bold; color: #555; }
        .monto-box { 
            background: #f8f9fa; 
            padding: 15px; 
            border: 1px solid #dee2e6; 
            text-align: center; 
            margin-top: 20px;
        }
        .monto { font-size: 22px; font-weight: bold; color: #28a745; }
        .footer { text-align: center; margin-top: 50px; font-size: 12px; color: #777; border-top: 1px solid #eee; padding-top: 10px; }
        table { width: 100%; }
        .text-right { text-align: right; }
    </style>
</head>
<body>

<div class="header">
    <h1>ODONCERE</h1>
    <p>Consultorio Odontológico<br>Recibo de Pago No. {{ str_pad($pago->id, 5, '0', STR_PAD_LEFT) }}</p>
</div>

<div class="section">
    <table>
        <tr>
            <td>
                <span class="label">Paciente:</span> {{ $pago->paciente->nombres }} {{ $pago->paciente->apellidos }}<br> <span class="label">Cédula/ID:</span> {{ $pago->paciente->identificacion }} </td>
            <td class="text-right">
                <span class="label">Fecha:</span> {{ $pago->created_at->format('d/m/Y') }}<br>
                <span class="label">Hora:</span> {{ $pago->created_at->format('h:i A') }}
            </td>
        </tr>
    </table>
</div>

<hr style="border: 0.5px solid #eee;">

<div class="section">
    <table>
        <tr>
            <td><span class="label">Método de Pago:</span> {{ $pago->metodo_pago }}</td> <td class="text-right">
                <span class="label">Tasa:</span> {{ number_format($pago->tasa_dia, 2) }} Bs/$
            </td>
        </tr>
        @if($pago->numero_operacion)
        <tr>
            <td colspan="2"><span class="label">Nro. de Operación:</span> {{ $pago->numero_operacion }}</td>
        </tr>
        @endif
    </table>
</div>

<div class="monto-box">
    <span class="label">TOTAL CANCELADO</span><br>
    <span class="monto">
        ${{ number_format($pago->monto_usd, 2) }} / {{ number_format($pago->monto_bs, 2) }} Bs. </span>
    @if($pago->vuelto_usd > 0)
        <p style="margin: 5px 0 0 0; color: #dc3545;">
            <strong>Vuelto entregado:</strong> ${{ number_format($pago->vuelto_usd, 2) }} </p>
    @endif
</div>

<div class="footer">
    <p>Este documento es un comprobante de pago electrónico para Odoncere.<br>
    ¡Gracias por confiar en nuestra clínica!</p>
</div>

</body>
</html>