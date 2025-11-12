<x-admin-layout
    title="Editar Usuario: {{ $user->name }}"
    :breadcrumbs="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Usuarios', 'url' => route('admin.users.index')],
        ['name' => $user->name],
    ]"
>
    <div class="p-6 bg-white rounded-lg shadow-lg">
        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block mb-2 text-sm font-bold text-gray-700">
                    Nombre completo
                </label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $user->name) }}"
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
                    value="{{ old('email', $user->email) }}"
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
                        Nueva contraseña
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow focus:outline-none focus:ring-2 focus:ring-blue-300"
                        placeholder="Dejar en blanco para conservar la actual"
                    >
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block mb-2 text-sm font-bold text-gray-700">
                        Confirmar nueva contraseña
                    </label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow focus:outline-none focus:ring-2 focus:ring-blue-300"
                        placeholder="Repite la nueva contraseña"
                    >
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <a
                    href="{{ route('admin.users.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                >
                    Cancelar
                </a>
                <button
                    type="submit"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg text-sm font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300"
                >
                    Actualizar usuario
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>

