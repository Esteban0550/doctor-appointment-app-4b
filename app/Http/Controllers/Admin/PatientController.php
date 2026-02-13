<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\BloodType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.patients.index');
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
    public function show(Patient $patient)
    {
        // Redirigir a la página de edición
        return redirect()->route('admin.patients.edit', $patient);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        $patient->load(['user', 'bloodType']);
        $bloodTypes = BloodType::all();
        return view('admin.patients.edit', compact('patient', 'bloodTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'blood_type_id' => ['nullable', 'exists:blood_types,id'],
            'allergies' => ['nullable', 'string', 'max:1000'],
            'chronic_conditions' => ['nullable', 'string', 'max:1000'],
            'surgical_history' => ['nullable', 'string', 'max:1000'],
            'family_history' => ['nullable', 'string', 'max:1000'],
            'observations' => ['nullable', 'string', 'max:2000'],
            'emergency_contact_name' => ['nullable', 'string', 'max:255'],
            'emergency_contact_phone' => ['nullable', 'string', 'max:20'],
            'emergency_contact_relationship' => ['nullable', 'string', 'max:255'],
        ]);

        // Sanitize phone number: remove parentheses, dashes, and spaces, keep only digits
        if (!empty($validated['emergency_contact_phone'])) {
            $validated['emergency_contact_phone'] = preg_replace('/[^0-9]/', '', $validated['emergency_contact_phone']);
            
            // Validate that it has exactly 10 digits
            if (strlen($validated['emergency_contact_phone']) !== 10) {
                return back()->withErrors([
                    'emergency_contact_phone' => 'El teléfono debe tener exactamente 10 dígitos.'
                ])->withInput();
            }
        }

        DB::beginTransaction();
        try {
            $patient->update($validated);

            DB::commit();

            session()->flash('swal', [
                'icon'  => 'success',
                'title' => 'Paciente actualizado',
                'text'  => 'Los datos del paciente han sido actualizados exitosamente.'
            ]);

            return redirect()->route('admin.patients.edit', $patient)->with('success', '¡Paciente actualizado exitosamente!');
        } catch (\Exception $e) {
            DB::rollBack();
            
            session()->flash('swal', [
                'icon'  => 'error',
                'title' => 'Error',
                'text'  => 'Ocurrió un error al actualizar el paciente. Por favor, intente nuevamente.'
            ]);

            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
