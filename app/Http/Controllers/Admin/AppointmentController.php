<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        return view('admin.appointments.index');
    }

    public function create()
    {
        return view('admin.appointments.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'doctor_id'  => ['required', 'integer', 'exists:doctors,id'],
            'date'       => ['required', 'date', 'after_or_equal:today'],
            'start_time' => ['required'],
            'end_time'   => ['required', 'after:start_time'],
            'reason'     => ['required', 'string', 'max:1000'],
        ], [
            'patient_id.required'  => 'El paciente es obligatorio.',
            'doctor_id.required'   => 'El doctor es obligatorio.',
            'date.required'        => 'La fecha es obligatoria.',
            'date.after_or_equal'  => 'La fecha no puede ser anterior a hoy.',
            'start_time.required'  => 'La hora de inicio es obligatoria.',
            'end_time.required'    => 'La hora de fin es obligatoria.',
            'end_time.after'       => 'La hora de fin debe ser posterior a la hora de inicio.',
            'reason.required'      => 'El motivo de la cita es obligatorio.',
        ]);

        Appointment::create([
            'patient_id' => $validated['patient_id'],
            'doctor_id'  => $validated['doctor_id'],
            'date'       => $validated['date'],
            'start_time' => $validated['start_time'],
            'end_time'   => $validated['end_time'],
            'duration'   => 15,
            'reason'     => $validated['reason'],
            'status'     => 1,
        ]);

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => '¡Cita registrada!',
            'text'  => 'La cita ha sido agendada correctamente.',
        ]);

        return redirect()->route('admin.appointments.index');
    }

    public function consultation(Appointment $appointment)
    {
        $appointment->load([
            'patient.user',
            'patient.bloodType',
            'doctor.user',
            'doctor.specialty',
            'consultation.prescriptionItems',
        ]);

        return view('admin.appointments.consultation', compact('appointment'));
    }
}
