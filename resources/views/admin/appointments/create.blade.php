<x-admin-layout
    title="Nueva Cita"
    :breadcrumbs="[
        ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
        ['name' => 'Citas',     'href' => route('admin.appointments.index')],
        ['name' => 'Nuevo'],
    ]"
>
    <section class="p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-lg">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Nuevo</h1>
        </div>

        @livewire('admin.appointment-create')
    </section>
</x-admin-layout>
