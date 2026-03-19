<?php

namespace App\Mail;

use App\Models\Appointment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppointmentConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Appointment $appointment)
    {
    }

    public function build()
    {
        $pdf = Pdf::loadView('pdf.appointment-receipt', [
            'appointment' => $this->appointment,
        ]);

        $tempPath = storage_path('app/comprobante-cita-' . $this->appointment->id . '.pdf');
        file_put_contents($tempPath, $pdf->output());

        $mail = $this->subject('Comprobante de Cita Médica')
            ->view('emails.appointment-confirmation')
            ->attach($tempPath, [
                'as' => 'comprobante-cita.pdf',
                'mime' => 'application/pdf',
            ]);

        register_shutdown_function(function () use ($tempPath) {
            @unlink($tempPath);
        });

        return $mail;
    }
}
