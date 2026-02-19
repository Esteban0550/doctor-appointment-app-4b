<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password'  => ['required', 'confirmed', Password::defaults()],
            'id_number' => ['nullable', 'string', 'max:255'],
            'phone'     => ['nullable', 'string', 'max:255'],
            'address'   => ['nullable', 'string'],
            'role'      => ['nullable', 'exists:roles,name'],
        ]);

        $user = User::create([
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'password'  => Hash::make($validated['password']),
            'id_number' => $validated['id_number'] ?? null,
            'phone'     => $validated['phone'] ?? null,
            'address'   => $validated['address'] ?? null,
        ]);

        $patient = null;
        $doctor = null;

        if (!empty($validated['role'])) {
            $user->assignRole($validated['role']);

            // Si el rol es "Paciente", crear registro de paciente
            if ($validated['role'] === 'Paciente') {
                $patient = Patient::firstOrCreate(['user_id' => $user->id]);
            }

            // Si el rol es "Doctor", crear registro de doctor
            if ($validated['role'] === 'Doctor') {
                $doctor = Doctor::firstOrCreate(
                    ['user_id' => $user->id],
                    [
                        'specialty_id' => \App\Models\Specialty::first()->id,
                        'license_number' => 'TEMP-' . $user->id . '-' . time(),
                    ]
                );
            }
        }

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Usuario creado correctamente',
            'text'  => 'El usuario ha sido creado exitosamente'
        ]);

        // Si es un doctor, redirigir a la página de edición del doctor
        if ($doctor) {
            return redirect()->route('admin.doctors.edit', $doctor)->with('success', '¡Doctor creado exitosamente!');
        }

        // Si es un paciente, redirigir a la página de edición del paciente
        if ($patient) {
            return redirect()->route('admin.patients.edit', $patient)->with('success', '¡Paciente creado exitosamente!');
        }

        return redirect()->route('admin.users.index')->with('success', '¡Usuario creado exitosamente!');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password'  => ['nullable', 'confirmed', Password::defaults()],
            'id_number' => ['nullable', 'string', 'max:255'],
            'phone'     => ['nullable', 'string', 'max:255'],
            'address'   => ['nullable', 'string'],
            'role'      => ['nullable', 'exists:roles,name'],
        ]);

        $data = [
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'id_number' => $validated['id_number'] ?? null,
            'phone'     => $validated['phone'] ?? null,
            'address'   => $validated['address'] ?? null,
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        // Actualizar rol
        $previousRoles = $user->roles->pluck('name')->toArray();
        
        if (!empty($validated['role'])) {
            $user->syncRoles([$validated['role']]);

            // Si el nuevo rol es "Paciente" y no tenía ese rol antes, crear registro de paciente
            if ($validated['role'] === 'Paciente' && !in_array('Paciente', $previousRoles)) {
                Patient::firstOrCreate(['user_id' => $user->id]);
            }

            // Si el rol cambió de "Paciente" a otro, eliminar registro de paciente
            if (in_array('Paciente', $previousRoles) && $validated['role'] !== 'Paciente') {
                $user->patient?->delete();
            }

            // Si el nuevo rol es "Doctor" y no tenía ese rol antes, crear registro de doctor
            if ($validated['role'] === 'Doctor' && !in_array('Doctor', $previousRoles)) {
                Doctor::firstOrCreate(
                    ['user_id' => $user->id],
                    [
                        'specialty_id' => \App\Models\Specialty::first()->id,
                        'license_number' => 'TEMP-' . $user->id . '-' . time(),
                    ]
                );
            }

            // Si el rol cambió de "Doctor" a otro, eliminar registro de doctor
            if (in_array('Doctor', $previousRoles) && $validated['role'] !== 'Doctor') {
                $user->doctor?->delete();
            }
        } else {
            $user->syncRoles([]);
            // Si tenía rol de Paciente, eliminar registro de paciente
            if (in_array('Paciente', $previousRoles)) {
                $user->patient?->delete();
            }
            // Si tenía rol de Doctor, eliminar registro de doctor
            if (in_array('Doctor', $previousRoles)) {
                $user->doctor?->delete();
            }
        }

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Usuario actualizado',
            'text'  => 'Los datos del usuario se han actualizado correctamente',
        ]);

        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        if (auth()->check() && auth()->id() === $user->id) {
            abort(403, 'No puedes eliminar tu propio usuario.');
        }

        $user->delete();

        session()->flash('swal', [
            'icon'  => 'success',
            'title' => 'Usuario eliminado',
            'text'  => 'El usuario ha sido eliminado correctamente',
        ]);

        return redirect()->route('admin.users.index');
    }
}


