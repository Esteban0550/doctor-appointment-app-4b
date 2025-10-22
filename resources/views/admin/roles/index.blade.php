<x-admin-layout 
    title="Roles"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'url'  => route('admin.dashboard')
        ],
        [
            'name' => 'Roles',
            'url'  => route('admin.roles.index')
        ]
    ]">

    {{-- 👇 AQUÍ EMPIEZA EL CONTENIDO DE TU PÁGINA 👇 --}}
    
    <div class="p-4 bg-white rounded-lg shadow-md">
        
        {{-- Botón para crear un nuevo rol --}}
        <div class="mb-4">
            <a href="{{ route('admin.roles.create') }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                Crear Nuevo Rol
            </a>
        </div>

        {{-- Aquí iría la tabla que muestra todos los roles --}}
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Nombre del Rol
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100"></th>
                </tr>
            </thead>
            <tbody>
                {{-- Aquí harías un bucle para mostrar cada rol --}}
                {{-- @foreach ($roles as $role) ... @endforeach --}}
            </tbody>
        </table>

    </div>

    {{-- 👆 AQUÍ TERMINA EL CONTENIDO DE TU PÁGINA 👆 --}}

</x-admin-layout>