<x-admin-layout
    title="Pacientes"
    :breadcrumbs="[
        ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
        ['name' => 'Pacientes', 'href' => route('admin.patients.index')],
    ]"
>
    <section class="p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-lg">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Pacientes
            </h1>
        </div>

        @if (session('message'))
            <div class="mb-4 rounded-lg bg-green-100 px-4 py-3 text-green-700">
                {{ session('message') }}
            </div>
        @endif

        @livewire('admin.datatables.patient-table')
    </section>
</x-admin-layout>

