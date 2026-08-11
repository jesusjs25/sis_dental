<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Pago;
use App\Models\Doctor;
use App\Models\Horario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citasPorEstado = Event::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        $etiquetas = $citasPorEstado->pluck('status');
        $valores = $citasPorEstado->pluck('total');
        

        //graficos de ventas
        // 1. Obtener la colección completa primero
        $ventasPorDia = Pago::selectRaw('DATE(created_at) as fecha, SUM(monto_bs) as total')
            ->groupBy('fecha')
            ->orderBy('fecha', 'ASC')
            ->get();

        // 2. Extraer etiquetas y valores en variables NUEVAS, no sobrescribiendo la original
        $etiquetasDia = $ventasPorDia->pluck('fecha');
        $valoresDia = $ventasPorDia->pluck('total');

        // Repite la misma lógica para semana y mes
        $ventasPorSemana = Pago::selectRaw('YEARWEEK(created_at, 1) as semana, SUM(monto_bs) as total')
            ->groupBy('semana')
            ->orderBy('semana', 'ASC')
            ->get();

        $etiquetasSemana = $ventasPorSemana->pluck('semana');
        $valoresSemana = $ventasPorSemana->pluck('total');

        $ventasPorMes = Pago::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as mes, SUM(monto_bs) as total")
            ->groupBy('mes')
            ->orderBy('mes', 'ASC')
            ->get();

        $etiquetasMes = $ventasPorMes->pluck('mes');
        $valoresMes = $ventasPorMes->pluck('total');
        

        //grafico de doctores
        // 1. Obtener todos los doctores para las etiquetas del eje X
        $doctores = Doctor::all();
        $etiquetasDoctores = $doctores->pluck('nombres'); // Suponiendo que la columna se llama 'nombre'

        // 2. Horas Trabajadas (Citas COMPLETADAS en la tabla 'events')
        $horasTrabajadasQuery = Event::selectRaw('doctor_id, SUM(TIMESTAMPDIFF(HOUR, start, end)) as total_trabajado')
            ->where('status', 'COMPLETADO')
            ->groupBy('doctor_id')
            ->pluck('total_trabajado', 'doctor_id'); // Guardamos como [doctor_id => total]

        // 3. Horas Programadas (Turnos en la tabla 'horarios')
        $horasProgramadasQuery = Horario::selectRaw('doctor_id, SUM(TIME_TO_SEC(TIMEDIFF(hora_fin, hora_inicio))) / 3600 as total_programado')
            ->groupBy('doctor_id')
            ->pluck('total_programado', 'doctor_id');

        // 4. Mapear los datos para que coincidan exactamente con el orden de los doctores
        $datosTrabajados = [];
        $datosProgramados = [];

        foreach ($doctores as $doctor) {
            // Si el doctor no tiene horas registradas, le asignamos 0
            $datosTrabajados[] = $horasTrabajadasQuery->get($doctor->id, 0);
            $datosProgramados[] = $horasProgramadasQuery->get($doctor->id, 0);
        }

        return view('admin.reportes.index', compact('citasPorEstado', 'etiquetas', 'valores', 
        'etiquetasDia', 'valoresDia', 'etiquetasSemana','valoresSemana', 'etiquetasMes','valoresMes',
        'etiquetasDoctores','datosProgramados','datosTrabajados'));
    }

    public function exportarCitasCsv(Request $request)
    {
        $nombreArchivo = 'reporte_citas_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$nombreArchivo",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        // Consultamos directamente la tabla 'events' uniendo con 'users' para paciente y doctor
        // (Ajusta los nombres de las columnas si difieren en tu base de datos)
        $citas = DB::table('events')
                    ->leftJoin('pacientes as pacientes', 'events.user_id', '=', 'pacientes.id')
                    ->leftJoin('doctors as doctors', 'events.doctor_id', '=', 'doctors.id')
                    ->whereIn('events.status', ['CANCELADO', 'COMPLETADO', 'Completado', 'Cancelado']) // Abarca ambos casos
                    ->select('events.*', 'pacientes.nombres as paciente_nombres', 'doctors.nombres as doctor_nombres')
                    ->orderBy('events.start', 'asc')
                    ->get();

        $callback = function() use ($citas) {
            $file = fopen('php://output', 'w');
            
            // BOM para que Excel reconozca las tildes (UTF-8)
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Encabezados de las columnas
            fputcsv($file, ['ID Cita', 'Título / Motivo', 'Paciente', 'Doctor', 'Fecha Inicio', 'Estado'], ';');

            // Llenar los datos
            foreach ($citas as $cita) {
                fputcsv($file, [
                    $cita->id,
                    $cita->title,
                    $cita->paciente_nombres ?? 'No registrado',
                    $cita->doctor_nombres ?? 'No asignado',
                    $cita->start,
                    $cita->status
                ], ';');
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportarVentasCsv(Request $request)
{
    $nombreArchivo = 'reporte_ventas_' . date('Y-m-d_H-i-s') . '.csv';

    $headers = [
        "Content-type"        => "text/csv; charset=UTF-8",
        "Content-Disposition" => "attachment; filename=$nombreArchivo",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    ];

    // Consultamos la tabla 'pagos' uniendo con 'users' para obtener el nombre del paciente
    $ventas = DB::table('pagos')
                ->leftJoin('pacientes as pacientes', 'pagos.paciente_id', '=', 'pacientes.id')
                ->select('pagos.*', 'pacientes.nombres as paciente_nombres')
                ->orderBy('pagos.created_at', 'desc')
                ->get();

    $callback = function() use ($ventas) {
        $file = fopen('php://output', 'w');
        
        // BOM para asegurar compatibilidad con tildes y caracteres en Excel (UTF-8)
        fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

        // Encabezados de las columnas del reporte de ventas/pagos
        fputcsv($file, ['ID Pago', 'Paciente', 'Monto USD', 'Tasa', 'Monto Bs', 'Método de Pago', 'Banco', 'Nro Operación', 'Fecha'], ';');

        // Llenar los datos fila por fila
        foreach ($ventas as $venta) {
            fputcsv($file, [
                $venta->id,
                $venta->paciente_nombres ?? 'No registrado',
                $venta->monto_usd,
                $venta->tasa_dia,
                $venta->monto_bs,
                $venta->metodo_pago,
                $venta->banco_destino ?? 'N/A',
                $venta->numero_operacion ?? 'N/A',
                $venta->created_at
            ], ';');
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

public function exportarDoctoresCsv(Request $request)
{
    $nombreArchivo = 'reporte_horas_doctores_' . date('Y-m-d_H-i-s') . '.csv';

    $headers = [
        "Content-type"        => "text/csv; charset=UTF-8",
        "Content-Disposition" => "attachment; filename=$nombreArchivo",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    ];

    // Consultamos la tabla 'doctors' cruzándola con 'horarios'
    $doctoresHorarios = DB::table('doctors')
                            ->leftJoin('horarios', 'doctors.id', '=', 'horarios.doctor_id')
                            ->select(
                                'doctors.id as doctor_id',
                                'doctors.nombres',
                                'doctors.apellidos',
                                'doctors.licencia_medica',
                                'doctors.especialidad',
                                'horarios.dia',
                                'horarios.hora_inicio',
                                'horarios.hora_fin'
                            )
                            ->orderBy('doctors.nombres', 'asc')
                            ->get();

    $callback = function() use ($doctoresHorarios) {
        $file = fopen('php://output', 'w');
        
        // BOM para asegurar compatibilidad con tildes y caracteres especiales en Excel (UTF-8)
        fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

        // Encabezados de las columnas
        fputcsv($file, ['ID Doctor', 'Nombres', 'Apellidos', 'Licencia Médica', 'Especialidad', 'Día de Atención', 'Hora Inicio', 'Hora Fin'], ';');

        // Llenar los datos fila por fila
        foreach ($doctoresHorarios as $row) {
            fputcsv($file, [
                $row->doctor_id,
                $row->nombres,
                $row->apellidos,
                $row->licencia_medica,
                $row->especialidad,
                $row->dia ?? 'No asignado',
                $row->hora_inicio ?? 'N/A',
                $row->hora_fin ?? 'N/A'
            ], ';');
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}
}
