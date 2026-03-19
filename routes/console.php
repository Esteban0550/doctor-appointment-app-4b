<?php

use App\Mail\DailyAppointmentReport;
use App\Models\Appointment;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('report:daily-appointments', function () {
    $appointments = Appointment::with(['patient.user', 'doctor.user'])
        ->whereDate('date', now()->toDateString())
        ->orderBy('start_time')
        ->get();

    $adminEmail = config('mail.admin_email', 'admin@example.com');

    Mail::to($adminEmail)->send(new DailyAppointmentReport($appointments));

    $this->info("Reporte diario enviado a {$adminEmail} con {$appointments->count()} citas.");
})->purpose('Enviar reporte diario de citas al administrador');

Schedule::command('report:daily-appointments')->dailyAt('08:00');
