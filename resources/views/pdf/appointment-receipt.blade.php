<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante de Cita Médica</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            color: #333;
            margin: 0;
            padding: 30px;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #2563eb;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            color: #666;
            margin: 5px 0 0;
        }
        .section {
            margin-bottom: 25px;
        }
        .section h2 {
            color: #2563eb;
            font-size: 16px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 8px 12px;
            border-bottom: 1px solid #eee;
        }
        .info-table td:first-child {
            font-weight: bold;
            width: 40%;
            color: #555;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #999;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
            color: white;
            background-color: #2563eb;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Comprobante de Cita Médica</h1>
        <p>Sistema de Gestión de Citas</p>
    </div>

    <div class="section">
        <h2>Datos del Paciente</h2>
        <table class="info-table">
            <tr>
                <td>Nombre:</td>
                <td>{{ $appointment->patient->user->name }}</td>
            </tr>
            <tr>
                <td>Correo Electrónico:</td>
                <td>{{ $appointment->patient->user->email }}</td>
            </tr>
            <tr>
                <td>Teléfono:</td>
                <td>{{ $appointment->patient->user->phone ?? 'No registrado' }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Datos de la Cita</h2>
        <table class="info-table">
            <tr>
                <td>Doctor:</td>
                <td>{{ $appointment->doctor->user->name }}</td>
            </tr>
            <tr>
                <td>Especialidad:</td>
                <td>{{ $appointment->doctor->specialty->name ?? 'General' }}</td>
            </tr>
            <tr>
                <td>Fecha:</td>
                <td>{{ $appointment->date->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td>Hora:</td>
                <td>{{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }} - {{ \Carbon\Carbon::parse($appointment->end_time)->format('h:i A') }}</td>
            </tr>
            <tr>
                <td>Motivo:</td>
                <td>{{ $appointment->reason }}</td>
            </tr>
            <tr>
                <td>Estado:</td>
                <td><span class="status-badge">{{ $appointment->status_label }}</span></td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Este comprobante fue generado automáticamente el {{ now()->format('d/m/Y H:i:s') }}</p>
        <p>Por favor, preséntese 15 minutos antes de su cita.</p>
    </div>
</body>
</html>
