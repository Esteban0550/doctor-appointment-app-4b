<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; }
        .container { max-width: 700px; margin: 0 auto; padding: 20px; }
        .header { background-color: #2563eb; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background-color: #f9fafb; padding: 25px; border: 1px solid #e5e7eb; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { background-color: #2563eb; color: white; padding: 10px; text-align: left; font-size: 13px; }
        td { padding: 10px; border-bottom: 1px solid #e5e7eb; font-size: 13px; }
        tr:nth-child(even) { background-color: #f3f4f6; }
        .footer { text-align: center; padding: 15px; font-size: 12px; color: #999; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 10px; font-size: 11px; font-weight: bold; }
        .badge-blue { background-color: #dbeafe; color: #2563eb; }
        .empty-msg { text-align: center; padding: 30px; color: #999; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="margin:0;">Reporte Diario de Citas</h1>
            <p style="margin:5px 0 0;">{{ now()->format('d/m/Y') }}</p>
        </div>
        <div class="content">
            <p>Buenos días, Administrador.</p>
            <p>A continuación se presenta el listado de pacientes agendados para el día de hoy:</p>

            @if($appointments->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Paciente</th>
                            <th>Doctor</th>
                            <th>Hora</th>
                            <th>Motivo</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $index => $appointment)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $appointment->patient->user->name }}</td>
                                <td>{{ $appointment->doctor->user->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}</td>
                                <td>{{ $appointment->reason }}</td>
                                <td><span class="badge badge-blue">{{ $appointment->status_label }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p style="margin-top:15px;"><strong>Total de citas:</strong> {{ $appointments->count() }}</p>
            @else
                <div class="empty-msg">
                    <p>No hay citas programadas para hoy.</p>
                </div>
            @endif
        </div>
        <div class="footer">
            <p>Este reporte fue generado automáticamente a las {{ now()->format('H:i:s') }}</p>
        </div>
    </div>
</body>
</html>
