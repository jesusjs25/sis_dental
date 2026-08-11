@extends('adminlte::page')

@section('content_header')
    <h1><b>Reportes</b></h1>
    <hr>
@stop

@section('content')
    <div class="alert alert-info" role="alert">
        <h4 class="alert-heading">Información</h4>
        <p>En esta sección se muestran los reportes de las citas registradas en el sistema.</p>
    </div>

    <div class="card">
    <div class="card-header">
        <h3 class="card-title">Reporte de Citas (Completadas, Terminadas y Canceladas)</h3>
        <div class="card-tools">
            {{-- Botón de exportación --}}
            <a href="{{ route('admin.reportes.citas.csv') }}" class="btn btn-success btn-sm">
                <i class="fas fa-file-csv"></i> Exportar a CSV
            </a>
        </div>
    </div>
    </div>

    <div class="card">
        <div class="card-body">
            <canvas id="citasChart"></canvas>
        </div>
    </div>

    <div class="alert alert-info" role="alert">
        <h4 class="alert-heading">Información</h4>
        <p>En esta sección se muestran los reportes de las ventas registradas en el sistema.</p>
    </div>
    <div class="card">
        <a href="{{ route('admin.reportes.ventas.csv') }}" class="btn btn-success btn-sm">
            <i class="fas fa-file-csv"></i> Exportar Ventas a CSV
        </a>
        <div class="card-body">
            <canvas id="ventasDiaChart"></canvas>
            <canvas id="ventasSemanaChart"></canvas>
            <canvas id="ventasMesChart"></canvas>
        </div>
    </div>

    <div class="alert alert-info" role="alert">
        <h4 class="alert-heading">Información</h4>
        <p>En esta sección se muestran los reportes de las horas trabajadas de los doctores.</p>
    </div>
    <div class="card">
        <a href="{{ route('admin.reportes.doctores.csv') }}" class="btn btn-success btn-sm">
            <i class="fas fa-file-csv"></i> Exportar Horas de Doctores a CSV
        </a>
        <div class="card-body">
            <canvas id="horasDoctoresChart"></canvas>
        </div>
    </div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    
@stop

@section('js')

<script>
    // 1. Obtenemos los datos desde PHP
    const etiquetas = @json($etiquetas);
    const valores = @json($valores);

    // 2. Inicializamos el gráfico
    const ctx = document.getElementById('citasChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie', // Tipo de gráfico: torta
        data: {
            labels: etiquetas,
            datasets: [{
                label: 'Citas',
                data: valores,
                backgroundColor: ['#ff6384', '#36a2eb', '#ffce56'] // Colores
            }]
        }
    });
</script>

<script>
    // 1. Obtenemos los datos desde PHP
    const etiquetasDia = @json($etiquetasDia);
    const valoresDia = @json($valoresDia);
    
    // 2. Inicializamos el gráfico
    const ctxDia = document.getElementById('ventasDiaChart').getContext('2d');
    new Chart(ctxDia, {
        type: 'bar', // Tipo de gráfico: barra
        data: {
            labels: etiquetasDia,
            datasets: [{
                label: 'Ventas',
                data: valoresDia,
                backgroundColor: '#ff6384', 
                borderColor: '#ff6384',
                borderWidth: 1
            }]
        }
    });
</script>

<script>
    // 1. Obtener los nuevos datos desde PHP
    const etiquetasDoctores = @json($etiquetasDoctores);
    const datosProgramados = @json($datosProgramados);
    const datosTrabajados = @json($datosTrabajados);

    // 2. Inicializar el gráfico comparativo
    const ctxHoras = document.getElementById('horasDoctoresChart').getContext('2d');
    new Chart(ctxHoras, {
        type: 'bar',
        data: {
            labels: etiquetasDoctores, // Nombres de los doctores en el eje X
            datasets: [
                {
                    label: 'Horas Programadas',
                    data: datosProgramados,
                    backgroundColor: '#36a2eb', // Azul para lo programado
                    borderWidth: 1
                },
                {
                    label: 'Horas Trabajadas',
                    data: datosTrabajados,
                    backgroundColor: '#ff6384', // Rojo/Rosa para lo trabajado
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true // Alinea el eje Y desde cero
                }
            }
        }
    });
</script>

@stop
