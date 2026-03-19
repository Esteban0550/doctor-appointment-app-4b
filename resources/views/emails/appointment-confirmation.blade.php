<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #2563eb; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background-color: #f9fafb; padding: 25px; border: 1px solid #e5e7eb; }
        .info-row { padding: 8px 0; border-bottom: 1px solid #e5e7eb; }
        .label { font-weight: bold; color: #555; }
        .footer { text-align: center; padding: 15px; font-size: 12px; color: #999; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="margin:0;">Confirmación de Cita Médica</h1>
        </div>
        <div class="content">
            <p>Estimado/a <strong>{{ $appointment->patient->user->name }}</strong>,</p>
            <p>Su cita médica ha sido registrada exitosamente. A continuación los detalles:</p>

            <div class="info-row">
                <span class="label">Doctor:</span> {{ $appointment->doctor->user->name }}
            </div>
            <div class="info-row">
                <span class="label">Especialidad:</span> {{ $appointment->doctor->specialty->name ?? 'General' }}
            </div>
            <div class="info-row">
                <span class="label">Fecha:</span> {{ $appointment->date->format('d/m/Y') }}
            </div>
            <div class="info-row">
                <span class="label">Hora:</span> {{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($appointment->end_time)->format('h:i A') }}
            </div>
            <div class="info-row">
                <span class="label">Motivo:</span> {{ $appointment->reason }}
            </div>

            <p style="margin-top:20px;">Se adjunta su comprobante en formato PDF. Por favor, preséntese 15 minutos antes de su cita.</p>
        </div>
        <div class="footer">
            <p>Este es un correo automático, por favor no responda a este mensaje.</p>
        </div>
    </div>
</body>
</html>
