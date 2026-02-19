<?php

namespace App\Livewire\Admin\Datatables;

use App\Models\Doctor;
use Livewire\Component;
use Livewire\WithPagination;

class DoctorTable extends Component
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
        $doctors = Doctor::query()
            ->with(['user.roles', 'specialty'])
            ->when($this->search, function ($query) {
                $query->whereHas('user', function ($subQuery) {
                    $subQuery
                        ->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('id_number', 'like', '%' . $this->search . '%');
                })->orWhereHas('specialty', function ($subQuery) {
                    $subQuery->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->orderByDesc('created_at')
            ->paginate($this->perPage);

        return view('livewire.admin.datatables.doctor-table', [
            'doctors' => $doctors,
        ]);
    }
}
