<x-admin-layout
    title="Editar Doctor"
    :breadcrumbs="[
        ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
        ['name' => 'Doctores', 'href' => route('admin.doctors.index')],
        ['name' => 'Editar'],
    ]"
>
    <form action="{{ route('admin.doctors.update', $doctor) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Encabezado con foto y acciones --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
            <div class="flex items-start justify-between gap-6">
                <div class="flex items-start gap-4">
                    <img
                        src="{{ $doctor->user->profile_photo_url }}"
                        alt="{{ $doctor->user->name }}"
                        class="h-20 w-20 rounded-full object-cover object-center flex-shrink-0"
                    >
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ $doctor->user->name }}
                        </h2>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">
                            Licencia: <span class="font-semibold">{{ $doctor->license_number ?? 'N/A' }}</span>
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <x-button
                        href="{{ route('admin.doctors.index') }}"
                        label="Volver"
                        flat
                    />
                    <x-button
                        type="submit"
                        label="Guardar cambios"
                        icon="check"
                        primary
                    />
                </div>
            </div>
        </div>

        {{-- Contenido del formulario --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Especialidad --}}
                <div>
                    <x-native-select
                        label="Especialidad"
                        name="specialty_id"
                        placeholder="Selecciona una especialidad"
                        :options="$specialties"
                        option-label="name"
                        option-value="id"
                        :value="old('specialty_id', $doctor->specialty_id)"
                    />
                </div>

                {{-- Número de Licencia --}}
                <div>
                    <x-input
                        label="Número de licencia médica"
                        name="license_number"
                        placeholder="Ej: MED-2025-001234"
                        :value="old('license_number', $doctor->license_number)"
                    />
                </div>

                {{-- Biografía --}}
                <div class="lg:col-span-2">
                    <x-textarea
                        label="Biografía"
                        name="biography"
                        placeholder="Escribe tu información profesional, experiencia, educación, especializaciones, certificados, etc."
                        rows="6"
                    >{{ old('biography', $doctor->biography) }}</x-textarea>
                </div>
            </div>
        </div>
    </form>

</x-admin-layout>
