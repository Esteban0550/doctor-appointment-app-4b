<div>
    {{-- Header --}}
    <div class="bg-white rounded-lg shadow p-6 mb-5">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    {{ $appointment->patient->user->name }}
                </h2>
                <p class="text-sm text-gray-500 mt-0.5">
                    DNI: {{ $appointment->patient->user->id_number ?? 'N/A' }}
                    <span class="mx-2 text-gray-300">|</span>
                    Doctor: {{ $appointment->doctor->user->name }}
                    @if ($appointment->doctor->specialty)
                        <span class="text-gray-400">({{ $appointment->doctor->specialty->name }})</span>
                    @endif
                </p>
                <p class="text-xs text-gray-400 mt-1">
                    <i class="fa-regular fa-calendar mr-1"></i>
                    {{ $appointment->date->format('d/m/Y') }}
                    &middot;
                    {{ \Illuminate\Support\Str::substr($appointment->start_time, 0, 5) }} - {{ \Illuminate\Support\Str::substr($appointment->end_time, 0, 5) }}
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a
                    href="{{ route('admin.patients.edit', $appointment->patient_id) }}"
                    class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors"
                >
                    <i class="fa-solid fa-file-medical text-blue-500"></i>
                    Ver Paciente
                </a>
                <button
                    wire:click="$set('showPreviousModal', true)"
                    class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors"
                >
                    <i class="fa-solid fa-clock-rotate-left text-gray-500"></i>
                    Consultas Anteriores
                </button>
            </div>
        </div>
    </div>

    {{-- Tabs + Content --}}
    <div class="bg-white rounded-lg shadow p-6">
        {{-- Tab headers --}}
        <div class="border-b border-gray-200 mb-6">
            <ul class="flex -mb-px text-sm font-medium">
                <li>
                    <button
                        wire:click="$set('activeTab', 'consulta')"
                        @class([
                            'inline-flex items-center gap-2 px-4 py-3 border-b-2 font-medium text-sm transition-colors',
                            'border-blue-600 text-blue-600'     => $activeTab === 'consulta',
                            'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' => $activeTab !== 'consulta',
                        ])
                    >
                        <i class="fa-regular fa-file-lines"></i>
                        Consulta
                        @if ($errors->has('diagnosis') || $errors->has('treatment'))
                            <span class="w-2 h-2 bg-red-500 rounded-full inline-block"></span>
                        @endif
                    </button>
                </li>
                <li>
                    <button
                        wire:click="$set('activeTab', 'receta')"
                        @class([
                            'inline-flex items-center gap-2 px-4 py-3 border-b-2 font-medium text-sm transition-colors',
                            'border-blue-600 text-blue-600'     => $activeTab === 'receta',
                            'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' => $activeTab !== 'receta',
                        ])
                    >
                        <i class="fa-solid fa-prescription"></i>
                        Receta
                        @php
                            $recetaErrors = collect($errors->keys())->filter(fn($k) => str_starts_with($k, 'medications.'))->isNotEmpty();
                        @endphp
                        @if ($recetaErrors)
                            <span class="w-2 h-2 bg-red-500 rounded-full inline-block"></span>
                        @endif
                    </button>
                </li>
            </ul>
        </div>

        {{-- TAB: Consulta --}}
        <div @class(['hidden' => $activeTab !== 'consulta'])>
            <div class="space-y-5">
                {{-- Diagnóstico --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Diagnóstico <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        wire:model="diagnosis"
                        rows="4"
                        placeholder="Describa el diagnóstico del paciente aquí..."
                        @class([
                            'w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none transition-colors',
                            'border-red-400 bg-red-50' => $errors->has('diagnosis'),
                            'border-gray-300'          => !$errors->has('diagnosis'),
                        ])
                    ></textarea>
                    @error('diagnosis')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tratamiento --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Tratamiento <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        wire:model="treatment"
                        rows="4"
                        placeholder="Describa el tratamiento recomendado aquí..."
                        @class([
                            'w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none transition-colors',
                            'border-red-400 bg-red-50' => $errors->has('treatment'),
                            'border-gray-300'          => !$errors->has('treatment'),
                        ])
                    ></textarea>
                    @error('treatment')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Notas --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Notas <span class="text-gray-400 text-xs">(opcional)</span>
                    </label>
                    <textarea
                        wire:model="notes"
                        rows="3"
                        placeholder="Agregue notas adicionales sobre la consulta..."
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 resize-none"
                    ></textarea>
                </div>
            </div>
        </div>

        {{-- TAB: Receta --}}
        <div @class(['hidden' => $activeTab !== 'receta'])>
            <div class="space-y-3">
                {{-- Header row --}}
                <div class="grid grid-cols-12 gap-3 text-xs font-semibold text-gray-600 uppercase tracking-wider px-1">
                    <div class="col-span-5">Medicamento</div>
                    <div class="col-span-3">Dosis</div>
                    <div class="col-span-3">Frecuencia / Duración</div>
                    <div class="col-span-1"></div>
                </div>

                @foreach ($medications as $index => $medication)
                    <div class="grid grid-cols-12 gap-3 items-start">
                        <div class="col-span-5">
                            <input
                                wire:model="medications.{{ $index }}.medicine_name"
                                type="text"
                                placeholder="Ej. Amoxicilina 500mg"
                                @class([
                                    'w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400',
                                    'border-red-400 bg-red-50' => $errors->has("medications.{$index}.medicine_name"),
                                    'border-gray-300'          => !$errors->has("medications.{$index}.medicine_name"),
                                ])
                            >
                            @error("medications.{$index}.medicine_name")
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-3">
                            <input
                                wire:model="medications.{{ $index }}.dose"
                                type="text"
                                placeholder="Ej. 1 cada 8 horas"
                                @class([
                                    'w-full px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400',
                                    'border-red-400 bg-red-50' => $errors->has("medications.{$index}.dose"),
                                    'border-gray-300'          => !$errors->has("medications.{$index}.dose"),
                                ])
                            >
                            @error("medications.{$index}.dose")
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-3">
                            <input
                                wire:model="medications.{{ $index }}.frequency"
                                type="text"
                                placeholder="Ej. cada 8 horas por 7 días"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                            >
                        </div>
                        <div class="col-span-1 flex items-center justify-center pt-1.5">
                            @if (count($medications) > 1)
                                <button
                                    wire:click="removeMedication({{ $index }})"
                                    class="p-1.5 text-white bg-red-500 hover:bg-red-600 rounded-md transition-colors"
                                    title="Eliminar medicamento"
                                >
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach

                <button
                    wire:click="addMedication"
                    class="inline-flex items-center gap-2 px-4 py-2 border border-dashed border-gray-300 text-sm text-gray-600 hover:text-gray-900 hover:border-gray-400 rounded-lg transition-colors"
                >
                    <i class="fa-solid fa-plus text-xs"></i>
                    Añadir Medicamento
                </button>
            </div>
        </div>

        {{-- Save button --}}
        <div class="flex justify-end mt-8 pt-6 border-t border-gray-100">
            <button
                wire:click="saveConsultation"
                wire:loading.attr="disabled"
                class="inline-flex items-center gap-2 px-6 py-2.5 bg-blue-600 hover:bg-blue-700 disabled:opacity-50 text-white text-sm font-medium rounded-lg shadow transition-colors"
            >
                <span wire:loading.remove wire:target="saveConsultation">
                    <i class="fa-solid fa-floppy-disk mr-1"></i>
                    Guardar Consulta
                </span>
                <span wire:loading wire:target="saveConsultation">Guardando...</span>
            </button>
        </div>
    </div>

    {{-- ===================== MODAL: Consultas Anteriores ===================== --}}
    @if ($showPreviousModal)
        <div
            x-data
            x-init="$nextTick(() => $el.querySelector('[data-modal-panel]').classList.add('opacity-100', 'scale-100'))"
            class="fixed inset-0 z-50 flex items-center justify-center p-4"
        >
            {{-- Backdrop --}}
            <div
                class="absolute inset-0 bg-black/50"
                wire:click="$set('showPreviousModal', false)"
            ></div>

            {{-- Panel --}}
            <div
                data-modal-panel
                class="relative bg-white rounded-xl shadow-2xl w-full max-w-3xl max-h-[85vh] flex flex-col opacity-0 scale-95 transition-all duration-200"
            >
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 flex-shrink-0">
                    <div>
                        <h3 class="text-base font-semibold text-gray-900">Consultas Anteriores</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Paciente: {{ $appointment->patient->user->name }}</p>
                    </div>
                    <button wire:click="$set('showPreviousModal', false)" class="text-gray-400 hover:text-gray-600">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <div class="overflow-y-auto px-6 py-4 space-y-4">
                    @forelse ($previousConsultations as $prevConsultation)
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            {{-- Consultation header - clickable --}}
                            <button
                                wire:click="selectConsultation({{ $prevConsultation->id }})"
                                class="w-full flex items-center justify-between px-4 py-3 bg-gray-50 hover:bg-gray-100 transition-colors text-left"
                            >
                                <div class="flex items-center gap-4">
                                    <div>
                                        <p class="text-sm font-semibold text-blue-700">
                                            <i class="fa-regular fa-calendar mr-1"></i>
                                            {{ $prevConsultation->appointment->date->format('d/m/Y') }}
                                            <span class="text-gray-500 font-normal">a las</span>
                                            {{ \Illuminate\Support\Str::substr($prevConsultation->appointment->start_time, 0, 5) }}
                                        </p>
                                        <p class="text-xs text-gray-500 mt-0.5">
                                            Dr(a). {{ $prevConsultation->appointment->doctor->user->name }}
                                            @if ($prevConsultation->appointment->doctor->specialty)
                                                <span class="text-gray-400">— {{ $prevConsultation->appointment->doctor->specialty->name }}</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <a
                                        href="{{ route('admin.appointments.consultation', $prevConsultation->appointment_id) }}"
                                        class="flex-shrink-0 inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-xs font-medium text-gray-700 hover:bg-gray-50 transition-colors"
                                        wire:click.stop
                                    >
                                        Abrir Consulta
                                    </a>
                                    <i @class([
                                        'fa-solid fa-chevron-down text-gray-400 text-xs transition-transform duration-200',
                                        'rotate-180' => $selectedConsultationId === $prevConsultation->id,
                                    ])></i>
                                </div>
                            </button>

                            {{-- Expandable detail --}}
                            @if ($selectedConsultationId === $prevConsultation->id)
                                <div class="px-4 py-4 border-t border-gray-200 space-y-3">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">
                                                <i class="fa-solid fa-stethoscope mr-1"></i> Diagnóstico
                                            </p>
                                            <p class="text-sm text-gray-800 bg-gray-50 rounded-md p-3">
                                                {{ $prevConsultation->diagnosis }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">
                                                <i class="fa-solid fa-kit-medical mr-1"></i> Tratamiento
                                            </p>
                                            <p class="text-sm text-gray-800 bg-gray-50 rounded-md p-3">
                                                {{ $prevConsultation->treatment }}
                                            </p>
                                        </div>
                                    </div>

                                    @if ($prevConsultation->notes)
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">
                                                <i class="fa-regular fa-note-sticky mr-1"></i> Notas
                                            </p>
                                            <p class="text-sm text-gray-700 bg-gray-50 rounded-md p-3">
                                                {{ $prevConsultation->notes }}
                                            </p>
                                        </div>
                                    @endif

                                    @if ($prevConsultation->prescriptionItems->count())
                                        <div>
                                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">
                                                <i class="fa-solid fa-prescription mr-1"></i> Medicamentos recetados
                                            </p>
                                            <div class="bg-gray-50 rounded-md overflow-hidden">
                                                <table class="w-full text-sm">
                                                    <thead>
                                                        <tr class="border-b border-gray-200">
                                                            <th class="px-3 py-2 text-left text-xs font-semibold text-gray-600">Medicamento</th>
                                                            <th class="px-3 py-2 text-left text-xs font-semibold text-gray-600">Dosis</th>
                                                            <th class="px-3 py-2 text-left text-xs font-semibold text-gray-600">Frecuencia</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($prevConsultation->prescriptionItems as $item)
                                                            <tr class="border-b border-gray-100 last:border-0">
                                                                <td class="px-3 py-2 text-gray-800">{{ $item->medicine_name }}</td>
                                                                <td class="px-3 py-2 text-gray-600">{{ $item->dose }}</td>
                                                                <td class="px-3 py-2 text-gray-600">{{ $item->frequency ?? '—' }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="py-10 text-center text-gray-500">
                            <i class="fa-solid fa-file-circle-xmark text-3xl mb-3 text-gray-300"></i>
                            <p>Este paciente no tiene consultas anteriores registradas.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    @endif
</div>
