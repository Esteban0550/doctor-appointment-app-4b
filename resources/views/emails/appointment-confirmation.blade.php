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
        .pdf-btn { display: inline-block; background-color: #2563eb; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: bold; margin-top: 15px; }
        .pdf-section { text-align: center; margin-top: 20px; padding: 20px; background-color: #eff6ff; border: 2px dashed #2563eb; border-radius: 8px; }
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

            <div class="pdf-section">
                <p style="margin:0 0 10px; font-weight:bold; color:#2563eb;">📄 Comprobante de Cita (PDF)</p>
                <a href="data:application/pdf;base64,{{ $pdfBase64 }}" download="comprobante-cita.pdf" class="pdf-btn" style="color:white;">
                    Descargar Comprobante PDF
                </a>
            </div>

            <p style="margin-top:20px;">Por favor, preséntese 15 minutos antes de su cita.</p>
        </div>
        <div class="footer">
            <p>Este es un correo automático, por favor no responda a este mensaje.</p>
        </div>
    </div>
</body>
</html>
