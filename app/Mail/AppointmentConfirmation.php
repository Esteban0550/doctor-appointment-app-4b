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

    public string $pdfBase64 = '';

    public function __construct(public Appointment $appointment)
    {
    }

    public function build()
    {
        $pdf = Pdf::loadView('pdf.appointment-receipt', [
            'appointment' => $this->appointment,
        ]);

        $this->pdfBase64 = base64_encode($pdf->output());

        return $this->subject('Comprobante de Cita Médica')
            ->view('emails.appointment-confirmation');
    }
}
