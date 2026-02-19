<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.doctors.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        // Redirigir a la página de edición
        return redirect()->route('admin.doctors.edit', $doctor);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        $doctor->load(['user', 'specialty']);
        $specialties = Specialty::all();
        return view('admin.doctors.edit', compact('doctor', 'specialties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'specialty_id' => ['required', 'exists:specialties,id'],
            'license_number' => ['required', 'string', 'max:50'],
            'biography' => ['nullable', 'string', 'max:2000'],
        ]);

        DB::beginTransaction();
        try {
            $doctor->update($validated);

            DB::commit();

            session()->flash('swal', [
                'icon'  => 'success',
                'title' => 'Doctor actualizado',
                'text'  => 'Los datos del doctor han sido actualizados exitosamente.'
            ]);

            return redirect()->route('admin.doctors.edit', $doctor)->with('success', '¡Doctor actualizado exitosamente!');
        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->withErrors([
                'general' => 'Error al actualizar el doctor: ' . $e->getMessage()
            ])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}
