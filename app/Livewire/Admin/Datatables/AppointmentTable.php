<?php

namespace App\Livewire\Admin\Datatables;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\WithPagination;

class AppointmentTable extends Component
{
    use WithPagination;

    public string $search = '';
    public int $perPage = 10;
    public string $filterDate = '';
    public string $filterStatus = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();
    }

    public function updatedFilterDate(): void
    {
        $this->resetPage();
    }

    public function updatedFilterStatus(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $appointments = Appointment::query()
            ->with(['patient.user', 'doctor.user'])
            ->when($this->search, function ($query) {
                $search = $this->search;
                $query->where(function ($q) use ($search) {
                    $q->whereHas('patient.user', function ($sub) use ($search) {
                        $sub->where('name', 'like', '%' . $search . '%');
                    })->orWhereHas('doctor.user', function ($sub) use ($search) {
                        $sub->where('name', 'like', '%' . $search . '%');
                    });
                });
            })
            ->when($this->filterDate, function ($query) {
                $query->whereDate('date', $this->filterDate);
            })
            ->when($this->filterStatus !== '', function ($query) {
                $query->where('status', (int) $this->filterStatus);
            })
            ->orderByDesc('date')
            ->orderByDesc('start_time')
            ->paginate($this->perPage);

        return view('livewire.admin.datatables.appointment-table', compact('appointments'));
    }
}
