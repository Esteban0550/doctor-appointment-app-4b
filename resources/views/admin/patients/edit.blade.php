<x-admin-layout
    title="Editar Paciente"
    :breadcrumbs="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Pacientes', 'url' => route('admin.patients.index')],
        ['name' => 'Editar', 'url' => route('admin.patients.edit', $patient)],
    ]"
>
    <section class="p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-lg">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Editar Paciente
            </h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Edición de paciente (pendiente de implementación)
            </p>
        </div>

        <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-6">
            <p class="text-gray-600 dark:text-gray-400">
                Paciente: {{ $patient->user->name }} ({{ $patient->user->email }})
            </p>
        </div>
    </section>
</x-admin-layout>

