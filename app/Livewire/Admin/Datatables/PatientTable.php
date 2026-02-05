<?php

namespace App\Livewire\Admin\Datatables;

use App\Models\Patient;
use Livewire\Component;
use Livewire\WithPagination;

class PatientTable extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $patients = Patient::query()
            ->with(['user.roles', 'bloodType'])
            ->when($this->search, function ($query) {
                $query->whereHas('user', function ($subQuery) {
                    $subQuery
                        ->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('id_number', 'like', '%' . $this->search . '%')
                        ->orWhere('phone', 'like', '%' . $this->search . '%');
                });
            })
            ->orderByDesc('created_at')
            ->paginate($this->perPage);

        return view('livewire.admin.datatables.patient-table', [
            'patients' => $patients,
        ]);
    }
}
