<table style="text-align:center" class="table table-bordered table-striped table-hover table-sm ">
                                <thead>
                                    <tr>
                                        <td>Hora</td>
                                        <td>Lunes</td>
                                        <td>Martes</td>
                                        <td>Miércoles</td>
                                        <td>Jueves</td>
                                        <td>Viernes</td>
                                        <td>Sabádos</td>
                                        <td>Domingo</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $horas = [
                                                '08:00:00 - 09:00:00',
                                                '09:00:00 - 10:00:00',
                                                '10:00:00 - 11:00:00',
                                                '11:00:00 - 12:00:00',
                                                '12:00:00 - 13:00:00',
                                                '13:00:00 - 14:00:00',
                                                '14:00:00 - 15:00:00',
                                                '15:00:00 - 16:00:00',
                                                '16:00:00 - 17:00:00',
                                                '17:00:00 - 18:00:00',
                                                '18:00:00 - 19:00:00',
                                                '19:00:00 - 20:00:00',

                                                ];
                                        $diasSemana = [

                                                    'LUNES',
                                                    'MARTES',
                                                    'MIERCOLES',
                                                    'JUEVES',
                                                    'VIERNES',
                                                    'SABADO',
                                                    'DOMINGO',

                                                    ];
                                    @endphp
                                    @foreach ($horas as $hora )
                                        @php
                                            list($hora_inicio,$hora_fin) = explode(' - ',$hora);
                                        @endphp
                                        <tr>
                                            <td>{{$hora}}</td>
                                            @foreach ($diasSemana as $dia)
                                                @php
                                                    $nombre_doctor = '';
                                                    foreach ($horarios as $horario){
                                                        if(strtoupper($horario->dia) == $dia &&
                                                        $hora_inicio >= $horario->hora_inicio &&
                                                        $hora_fin <= $horario->hora_fin){
                                                            $nombre_doctor = $horario->doctor->nombres ." ". $horario->doctor->apellidos;
                                                            break;
                                                        }
                                                
                                                    }
                                                @endphp   
                                                <td>{{$nombre_doctor}}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>