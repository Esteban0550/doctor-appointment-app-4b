@php
    // Definimos qué campos pertenecen a cada pestaña para detectar errores
    $errorGroups = [
        'antecedentes' => ['allergies', 'chronic_conditions', 'surgical_history', 'family_history'],
        'informacion_general' => ['blood_type_id', 'observations'],
        'contacto_emergencia' => ['emergency_contact_name', 'emergency_contact_phone', 'emergency_contact_relationship']
    ];

    // Pestaña por defecto
    $initialTab = 'datos-personales';

    // Si hay errores, buscamos en qué grupo están para abrir esa pestaña automáticamente
    foreach ($errorGroups as $tabName => $fields) {
        if ($errors->hasAny($fields)) {
            $initialTab = str_replace('_', '-', $tabName);
            break;
        }
    }
@endphp

<x-admin-layout
    title="Editar Paciente"
    :breadcrumbs="[
        ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
        ['name' => 'Pacientes', 'href' => route('admin.patients.index')],
        ['name' => 'Editar'],
    ]"
>
    <form action="{{ route('admin.patients.update', $patient) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Encabezado con foto y acciones --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <img 
                        src="{{ $patient->user->profile_photo_url }}" 
                        alt="{{ $patient->user->name }}"
                        class="h-16 w-16 rounded-full object-cover object-center"
                    >
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ $patient->user->name }}
                    </h2>
                </div>
                <div class="flex items-center gap-3">
                    <a
                        href="{{ route('admin.patients.index') }}"
                        class="inline-flex items-center justify-center px-5 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200 transition-colors dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600"
                    >
                        Volver
                    </a>
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors"
                    >
                        <i class="fa-solid fa-check mr-2"></i>
                        Guardar cambios
                    </button>
                </div>
            </div>
        </div>

        {{-- Tabs de navegación --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <x-tabs :initialTab="$initialTab">
                {{-- Menú de pestañas --}}
                <div class="border-b border-gray-200 dark:border-gray-700 mb-6">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                        <x-tabs-link tab="datos-personales" :activeTab="$initialTab" icon="user">
                            Datos Personales
                        </x-tabs-link>

                        <x-tabs-link 
                            tab="antecedentes" 
                            :activeTab="$initialTab" 
                            icon="file-lines"
                            :hasError="$errors->hasAny($errorGroups['antecedentes'])"
                        >
                            Antecedentes
                        </x-tabs-link>

                        <x-tabs-link 
                            tab="informacion-general" 
                            :activeTab="$initialTab" 
                            icon="info"
                            :hasError="$errors->hasAny($errorGroups['informacion_general'])"
                        >
                            Información General
                        </x-tabs-link>

                        <x-tabs-link 
                            tab="contacto-emergencia" 
                            :activeTab="$initialTab" 
                            icon="heart"
                            :hasError="$errors->hasAny($errorGroups['contacto_emergencia'])"
                        >
                            Contacto de Emergencia
                        </x-tabs-link>
                    </ul>
                </div>

                {{-- Contenido de las pestañas --}}
                <div>
                    {{-- Tab 1: Datos Personales --}}
                    <x-tabs-content tab="datos-personales">
                        {{-- Recuadro informativo con botón --}}
                        <div class="bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-500 p-4 mb-6 flex items-start justify-between gap-4">
                            <div class="flex items-start gap-3">
                                <i class="fa-solid fa-user-edit text-blue-500 text-xl mt-1"></i>
                                <div>
                                    <h3 class="text-blue-700 dark:text-blue-400 font-semibold text-base mb-1">
                                        Edición de cuenta de usuario
                                    </h3>
                                    <p class="text-blue-600 dark:text-blue-300 text-sm">
                                        La información de acceso (Nombre, Email y Contraseña) debe gestionarse desde la cuenta de usuario asociada.
                                    </p>
                                </div>
                            </div>
                            <a 
                                href="{{ route('admin.users.edit', $patient->user) }}" 
                                class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors whitespace-nowrap"
                            >
                                Editar Usuario
                                <i class="fa-solid fa-external-link-alt ml-2"></i>
                            </a>
                        </div>

                        {{-- Grid de información --}}
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                            <div>
                                <span class="text-gray-700 dark:text-gray-300 font-medium text-sm">
                                    Teléfono:
                                </span>
                                <p class="text-gray-900 dark:text-gray-100 text-base mt-1">
                                    {{ $patient->user->phone ?? '-' }}
                                </p>
                            </div>
                            <div>
                                <span class="text-gray-700 dark:text-gray-300 font-medium text-sm">
                                    Email:
                                </span>
                                <p class="text-gray-900 dark:text-gray-100 text-base mt-1">
                                    {{ $patient->user->email }}
                                </p>
                            </div>
                        </div>

                        <div>
                            <span class="text-gray-700 dark:text-gray-300 font-medium text-sm">
                                Dirección:
                            </span>
                            <p class="text-gray-900 dark:text-gray-100 text-base mt-1">
                                {{ $patient->user->address ?? '-' }}
                            </p>
                        </div>
                    </x-tabs-content>

                    {{-- Tab 2: Antecedentes --}}
                    <x-tabs-content tab="antecedentes">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <div>
                                <label for="allergies" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Alergias conocidas
                                </label>
                                <textarea
                                    id="allergies"
                                    name="allergies"
                                    rows="4"
                                    placeholder="Ej: Penicilina, mariscos, polen"
                                    class="w-full px-3 py-2 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400"
                                >{{ old('allergies', $patient->allergies) }}</textarea>
                                @error('allergies')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="chronic_conditions" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Enfermedades crónicas
                                </label>
                                <textarea
                                    id="chronic_conditions"
                                    name="chronic_conditions"
                                    rows="4"
                                    placeholder="Ej: Hipertensión, diabetes"
                                    class="w-full px-3 py-2 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400"
                                >{{ old('chronic_conditions', $patient->chronic_conditions) }}</textarea>
                                @error('chronic_conditions')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="surgical_history" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Antecedentes quirúrgicos
                                </label>
                                <textarea
                                    id="surgical_history"
                                    name="surgical_history"
                                    rows="4"
                                    placeholder="Ej: Apendicectomía (2019)"
                                    class="w-full px-3 py-2 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400"
                                >{{ old('surgical_history', $patient->surgical_history) }}</textarea>
                                @error('surgical_history')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="family_history" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Antecedentes familiares
                                </label>
                                <textarea
                                    id="family_history"
                                    name="family_history"
                                    rows="4"
                                    placeholder="Ej: Antecedentes de cardiopatías"
                                    class="w-full px-3 py-2 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400"
                                >{{ old('family_history', $patient->family_history) }}</textarea>
                                @error('family_history')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </x-tabs-content>

                    {{-- Tab 3: Información General --}}
                    <x-tabs-content tab="informacion-general">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <div>
                                <label for="blood_type_id" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Tipo de sangre
                                </label>
                                <select
                                    id="blood_type_id"
                                    name="blood_type_id"
                                    class="w-full px-3 py-2 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                                >
                                    <option value="">Selecciona un tipo de sangre</option>
                                    @foreach($bloodTypes as $bloodType)
                                        <option 
                                            value="{{ $bloodType->id }}"
                                            {{ old('blood_type_id', $patient->blood_type_id) == $bloodType->id ? 'selected' : '' }}
                                        >
                                            {{ $bloodType->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('blood_type_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div></div>
                            <div class="lg:col-span-2">
                                <label for="observations" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Observaciones
                                </label>
                                <textarea
                                    id="observations"
                                    name="observations"
                                    rows="6"
                                    placeholder="Escribe observaciones relevantes"
                                    class="w-full px-3 py-2 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400"
                                >{{ old('observations', $patient->observations) }}</textarea>
                                @error('observations')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </x-tabs-content>

                    {{-- Tab 4: Contacto de Emergencia --}}
                    <x-tabs-content tab="contacto-emergencia">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <div>
                                <label for="emergency_contact_name" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Nombre del contacto
                                </label>
                                <input
                                    type="text"
                                    id="emergency_contact_name"
                                    name="emergency_contact_name"
                                    value="{{ old('emergency_contact_name', $patient->emergency_contact_name) }}"
                                    placeholder="Nombre completo"
                                    class="w-full px-3 py-2 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400"
                                />
                                @error('emergency_contact_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                @php
                                    $phoneValue = old('emergency_contact_phone', $patient->emergency_contact_phone);
                                    // Format phone if it's stored as 10 digits
                                    if ($phoneValue && strlen($phoneValue) === 10 && ctype_digit($phoneValue)) {
                                        $phoneValue = '(' . substr($phoneValue, 0, 3) . ') ' . substr($phoneValue, 3, 3) . '-' . substr($phoneValue, 6);
                                    }
                                @endphp
                                <label for="emergency_contact_phone" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Teléfono de emergencia
                                </label>
                                <input
                                    type="text"
                                    id="emergency_contact_phone"
                                    name="emergency_contact_phone"
                                    value="{{ $phoneValue }}"
                                    placeholder="(555) 555-5555"
                                    maxlength="14"
                                    class="w-full px-3 py-2 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400"
                                    x-data="{ phone: '{{ $phoneValue }}' }"
                                    x-on:input="
                                        let value = $event.target.value.replace(/\D/g, '');
                                        if (value.length <= 10) {
                                            if (value.length >= 6) {
                                                $event.target.value = '(' + value.substring(0, 3) + ') ' + value.substring(3, 6) + '-' + value.substring(6);
                                            } else if (value.length >= 3) {
                                                $event.target.value = '(' + value.substring(0, 3) + ') ' + value.substring(3);
                                            } else {
                                                $event.target.value = value;
                                            }
                                        }
                                    "
                                />
                                @error('emergency_contact_phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="lg:col-span-2">
                                <label for="emergency_contact_relationship" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Relación
                                </label>
                                <input
                                    type="text"
                                    id="emergency_contact_relationship"
                                    name="emergency_contact_relationship"
                                    value="{{ old('emergency_contact_relationship', $patient->emergency_contact_relationship) }}"
                                    placeholder="Ej: Padre, Madre, Cónyuge, etc."
                                    class="w-full px-3 py-2 text-gray-700 bg-gray-50 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400"
                                />
                                @error('emergency_contact_relationship')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </x-tabs-content>
                </div>
            </x-tabs>
        </div>
    </form>

</x-admin-layout>
