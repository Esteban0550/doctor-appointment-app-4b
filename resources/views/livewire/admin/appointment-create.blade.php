<div>
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-bold text-gray-900 mb-1">Registrar nueva cita</h2>
        <p class="text-sm text-gray-500 mb-6">Complete los datos para agendar una cita médica.</p>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Paciente --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Paciente <span class="text-red-500">*</span>
                </label>
                <select
                    wire:model="patientId"
                    @class([
                        'w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition-colors',
                        'border-red-400 bg-red-50' => $errors->has('patientId'),
                        'border-gray-300 bg-gray-50' => !$errors->has('patientId'),
                    ])
                >
                    <option value="">Seleccionar paciente</option>
                    @foreach ($patients as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->user->name }}</option>
                    @endforeach
                </select>
                @error('patientId')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Doctor --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Doctor <span class="text-red-500">*</span>
                </label>
                <select
                    wire:model="doctorId"
                    @class([
                        'w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition-colors',
                        'border-red-400 bg-red-50' => $errors->has('doctorId'),
                        'border-gray-300 bg-gray-50' => !$errors->has('doctorId'),
                    ])
                >
                    <option value="">Seleccionar doctor</option>
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->user->name }}</option>
                    @endforeach
                </select>
                @error('doctorId')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Fecha --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Fecha <span class="text-red-500">*</span>
                </label>
                <input
                    wire:model="date"
                    type="date"
                    min="{{ now()->format('Y-m-d') }}"
                    @class([
                        'w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition-colors',
                        'border-red-400 bg-red-50' => $errors->has('date'),
                        'border-gray-300 bg-gray-50' => !$errors->has('date'),
                    ])
                >
                @error('date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Hora inicio --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Hora inicio <span class="text-red-500">*</span>
                </label>
                <input
                    wire:model="startTime"
                    type="time"
                    step="300"
                    class="w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition-colors {{ $errors->has('startTime') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}"
                >
                @error('startTime')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Hora fin --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Hora fin <span class="text-red-500">*</span>
                </label>
                <input
                    wire:model="endTime"
                    type="time"
                    step="300"
                    class="w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition-colors {{ $errors->has('endTime') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}"
                >
                @error('endTime')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Motivo --}}
            <div class="lg:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Motivo de la cita <span class="text-red-500">*</span>
                </label>
                <textarea
                    wire:model="reason"
                    rows="3"
                    placeholder="Describa el motivo de la cita..."
                    @class([
                        'w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none transition-colors',
                        'border-red-400 bg-red-50' => $errors->has('reason'),
                        'border-gray-300 bg-gray-50' => !$errors->has('reason'),
                    ])
                ></textarea>
                @error('reason')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center justify-end gap-3 mt-6 pt-6 border-t border-gray-100">
            <a
                href="{{ route('admin.appointments.index') }}"
                class="px-4 py-2.5 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors"
            >
                Cancelar
            </a>
            <button
                wire:click="save"
                wire:loading.attr="disabled"
                class="inline-flex items-center gap-2 px-6 py-2.5 bg-blue-600 hover:bg-blue-700 disabled:opacity-50 text-white text-sm font-medium rounded-lg shadow transition-colors"
            >
                <span wire:loading.remove wire:target="save">
                    <i class="fa-solid fa-check mr-1"></i>
                    Registrar cita
                </span>
                <span wire:loading wire:target="save">Guardando...</span>
            </button>
        </div>
    </div>
</div>
