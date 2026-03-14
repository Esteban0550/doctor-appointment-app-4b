<x-admin-layout
    title="Citas Médicas"
    :breadcrumbs="[
        ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
        ['name' => 'Citas', 'href' => route('admin.appointments.index')],
    ]"
>
    <section class="p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-lg">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Citas
            </h1>
            <a
                href="{{ route('admin.appointments.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow transition-colors"
            >
                <i class="fa-solid fa-plus"></i>
                Nuevo
            </a>
        </div>

        @livewire('admin.datatables.appointment-table')
    </section>
</x-admin-layout>
