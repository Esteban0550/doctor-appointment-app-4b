<x-admin-layout 
    title="Roles"
    :breadcrumbs="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Roles',     'url' => route('admin.roles.index')],
    ]"
>
    <section class="p-4 bg-white rounded-lg shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-lg font-semibold text-gray-800">Roles</h1>

            <a
                href="{{ route('admin.roles.create') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                Crear nuevo rol
            </a>
        </div>

        @livewire('admin.datatables.role-table')
    </section>
</x-admin-layout>