<div class="timeline">
    @foreach($appointments as $date => $group)
        <div class="time-label">
            <span class="bg-blue">{{ $date }}</span>
        </div>
        @foreach($group as $cita)
        <div>
            <i class="fas fa-tooth bg-info"></i>
            <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i> {{ $cita->created_at->format('H:i') }}</span>
                <h3 class="timeline-header"><b>Procedimiento:</b> {{ $cita->procedimiento_realizado }}</h3>
                <div class="timeline-body">
                    <p><strong>Motivo:</strong> {{ $cita->motivo_consulta }}</p>
                    <p><strong>Diagnóstico:</strong> {{ $cita->diagnostico }}</p>
                    <p><strong>Observaciones:</strong> {{ $cita->observaciones }}</p>
                </div>
                <div class="timeline-footer">
                    @if($cita->payment_amount > 0)
                        <span class="badge badge-success">Pago realizado: ${{ $cita->payment_amount }}</span>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    @endforeach
    <div>
        <i class="fas fa-clock bg-gray"></i>
    </div>
</div>