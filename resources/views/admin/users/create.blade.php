<x-admin-layout
    title="Crear Usuario"
    :breadcrumbs="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Usuarios', 'url' => route('admin.users.index')],
        ['name' => 'Crear'],
    ]"
>
    <div class="p-6 bg-white rounded-lg shadow-lg">
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block mb-2 text-sm font-bold text-gray-700">
                    Nombre completo
                </label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow focus:outline-none focus:ring-2 focus:ring-blue-300"
                    required
                >
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block mb-2 text-sm font-bold text-gray-700">
                    Correo electrónico
                </label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow focus:outline-none focus:ring-2 focus:ring-blue-300"
                    required
                >
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <div>
                    <label for="password" class="block mb-2 text-sm font-bold text-gray-700">
                        Contraseña
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow focus:outline-none focus:ring-2 focus:ring-blue-300"
                        required
                    >
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block mb-2 text-sm font-bold text-gray-700">
                        Confirmar contraseña
                    </label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow focus:outline-none focus:ring-2 focus:ring-blue-300"
                        required
                    >
                </div>
            </div>

            <div class="flex justify-end gap-3">
                <a
                    href="{{ route('admin.users.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 transition-colors duration-150"
                >
                    Cancelar
                </a>
                <button
                    type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-400 border border-transparent rounded-lg text-xs font-semibold uppercase tracking-widest text-blue-900 hover:bg-blue-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-offset-2 transition-colors duration-150"
                >
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Guardar usuario
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>

