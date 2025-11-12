<?php

namespace App\Livewire\Admin\Datatables;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
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
        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery
                        ->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->orderByDesc('created_at')
            ->paginate($this->perPage);

        return view('livewire.admin.datatables.user-table', [
            'users' => $users,
        ]);
    }

    public function delete(int $userId): void
    {
        $user = User::findOrFail($userId);

        if (auth()->check() && auth()->id() === $user->id) {
            session()->flash('message', 'No puedes eliminar tu propio usuario mientras estás autenticado.');
            return;
        }

        $user->delete();

        session()->flash('message', 'Usuario eliminado exitosamente.');

        $this->resetPage();
    }
}


