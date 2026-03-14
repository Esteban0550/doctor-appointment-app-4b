<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Livewire\Component;

class AppointmentCreate extends Component
{
    public mixed  $patientId  = null;
    public mixed  $doctorId   = null;
    public string $date       = '';
    public string $startTime  = '';
    public string $endTime    = '';
    public string $reason     = '';

    public function mount(): void
    {
        $this->date = now()->format('Y-m-d');
    }

    protected function rules(): array
    {
        return [
            'patientId' => ['required', 'integer', 'exists:patients,id'],
            'doctorId'  => ['required', 'integer', 'exists:doctors,id'],
            'date'      => ['required', 'date', 'after_or_equal:today'],
            'startTime' => ['required'],
            'endTime'   => ['required', 'after:startTime'],
            'reason'    => ['required', 'string', 'max:1000'],
        ];
    }

    protected function messages(): array
    {
        return [
            'patientId.required'  => 'El paciente es obligatorio.',
            'doctorId.required'   => 'El doctor es obligatorio.',
            'date.required'       => 'La fecha es obligatoria.',
            'date.after_or_equal' => 'La fecha no puede ser anterior a hoy.',
            'startTime.required'  => 'La hora de inicio es obligatoria.',
            'endTime.required'    => 'La hora de fin es obligatoria.',
            'endTime.after'       => 'La hora de fin debe ser posterior a la hora de inicio.',
            'reason.required'     => 'El motivo de la cita es obligatorio.',
        ];
    }

    public function save()
    {
        $this->validate();

        Appointment::create([
            'patient_id' => $this->patientId,
            'doctor_id'  => $this->doctorId,
            'date'       => $this->date,
            'start_time' => $this->startTime,
            'end_time'   => $this->endTime,
            'duration'   => 15,
            'reason'     => $this->reason,
            'status'     => 1,
        ]);

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => '¡Cita registrada!',
            'text'  => 'La cita ha sido agendada correctamente.',
        ]);

        return redirect()->route('admin.appointments.index');
    }

    public function render()
    {
        $patients = Patient::with('user')->orderBy('id')->get();
        $doctors  = Doctor::with('user')->orderBy('id')->get();

        return view('livewire.admin.appointment-create', compact('patients', 'doctors'));
    }
}
