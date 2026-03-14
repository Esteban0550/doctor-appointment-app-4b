<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\Consultation;
use Livewire\Component;

class ConsultationManager extends Component
{
    public Appointment $appointment;
    public string      $activeTab = 'consulta';

    // Consulta fields
    public string $diagnosis = '';
    public string $treatment = '';
    public string $notes     = '';

    // Receta
    public array $medications = [];

    // Modals
    public bool $showHistoryModal   = false;
    public bool $showPreviousModal  = false;

    // Selected previous consultation for detail view
    public ?int $selectedConsultationId = null;

    public function mount(Appointment $appointment): void
    {
        $this->appointment = $appointment;
        $this->appointment->load([
            'patient.user',
            'patient.bloodType',
            'doctor.user',
            'doctor.specialty',
            'consultation.prescriptionItems',
        ]);

        if ($consultation = $this->appointment->consultation) {
            $this->diagnosis = $consultation->diagnosis ?? '';
            $this->treatment = $consultation->treatment ?? '';
            $this->notes     = $consultation->notes     ?? '';

            $this->medications = $consultation->prescriptionItems
                ->map(fn ($item) => [
                    'medicine_name' => $item->medicine_name,
                    'dose'          => $item->dose,
                    'frequency'     => $item->frequency ?? '',
                ])
                ->toArray();
        }

        if (empty($this->medications)) {
            $this->medications = [['medicine_name' => '', 'dose' => '', 'frequency' => '']];
        }
    }

    protected function rules(): array
    {
        return [
            'diagnosis'                   => ['required', 'string'],
            'treatment'                   => ['required', 'string'],
            'notes'                       => ['nullable', 'string'],
            'medications.*.medicine_name' => ['required', 'string', 'max:255'],
            'medications.*.dose'          => ['required', 'string', 'max:255'],
            'medications.*.frequency'     => ['nullable', 'string', 'max:255'],
        ];
    }

    protected function messages(): array
    {
        return [
            'diagnosis.required'                   => 'El diagnóstico es obligatorio.',
            'treatment.required'                   => 'El tratamiento es obligatorio.',
            'medications.*.medicine_name.required'  => 'El nombre del medicamento es obligatorio.',
            'medications.*.dose.required'           => 'La dosis es obligatoria.',
        ];
    }

    public function addMedication(): void
    {
        $this->medications[] = ['medicine_name' => '', 'dose' => '', 'frequency' => ''];
    }

    public function removeMedication(int $index): void
    {
        unset($this->medications[$index]);
        $this->medications = array_values($this->medications);

        if (empty($this->medications)) {
            $this->medications = [['medicine_name' => '', 'dose' => '', 'frequency' => '']];
        }
    }

    public function selectConsultation(int $id): void
    {
        $this->selectedConsultationId = $this->selectedConsultationId === $id ? null : $id;
    }

    public function saveConsultation()
    {
        // Remove completely empty rows before validating
        $this->medications = array_values(
            array_filter(
                $this->medications,
                fn ($m) => trim($m['medicine_name'] ?? '') !== '' || trim($m['dose'] ?? '') !== ''
            )
        );

        if (empty($this->medications)) {
            $this->medications = [['medicine_name' => '', 'dose' => '', 'frequency' => '']];
        }

        try {
            $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->errors();

            if (!empty($errors['diagnosis']) || !empty($errors['treatment'])) {
                $this->activeTab = 'consulta';
            } else {
                foreach (array_keys($errors) as $key) {
                    if (str_starts_with($key, 'medications.')) {
                        $this->activeTab = 'receta';
                        break;
                    }
                }
            }
            throw $e;
        }

        $consultation = Consultation::updateOrCreate(
            ['appointment_id' => $this->appointment->id],
            [
                'diagnosis' => $this->diagnosis,
                'treatment' => $this->treatment,
                'notes'     => $this->notes ?: null,
            ]
        );

        $consultation->prescriptionItems()->delete();

        foreach ($this->medications as $med) {
            if (trim($med['medicine_name']) !== '') {
                $consultation->prescriptionItems()->create([
                    'medicine_name' => $med['medicine_name'],
                    'dose'          => $med['dose'],
                    'frequency'     => $med['frequency'] ?: null,
                ]);
            }
        }

        $this->appointment->update(['status' => 2]);

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => '¡Consulta guardada!',
            'text'  => 'La consulta ha sido registrada correctamente.',
        ]);

        return redirect()->route('admin.appointments.index');
    }

    public function render()
    {
        $previousConsultations = Consultation::whereHas('appointment', function ($q) {
            $q->where('patient_id', $this->appointment->patient_id)
              ->where('id', '!=', $this->appointment->id)
              ->where('status', 2);
        })
        ->with(['appointment.doctor.user', 'appointment.doctor.specialty', 'appointment', 'prescriptionItems'])
        ->orderByDesc('created_at')
        ->get();

        return view('livewire.admin.consultation-manager', compact('previousConsultations'));
    }
}
