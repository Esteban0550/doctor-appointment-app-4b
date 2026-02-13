<x-admin-layout
    title="Editar Usuario: {{ $user->name }}"
    :breadcrumbs="[
        ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
        ['name' => 'Usuarios', 'href' => route('admin.users.index')],
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
                    <label for="id_number" class="block mb-2 text-sm font-bold text-gray-700">
                        Número de ID
                    </label>
                    <input
                        type="text"
                        id="id_number"
                        name="id_number"
                        value="{{ old('id_number', $user->id_number) }}"
                        class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow focus:outline-none focus:ring-2 focus:ring-blue-300"
                        placeholder="1234567890"
                    >
                    @error('id_number')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block mb-2 text-sm font-bold text-gray-700">
                        Teléfono
                    </label>
                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        value="{{ old('phone', $user->phone) }}"
                        class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow focus:outline-none focus:ring-2 focus:ring-blue-300"
                        placeholder="5555555555"
                    >
                    @error('phone')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="address" class="block mb-2 text-sm font-bold text-gray-700">
                    Dirección
                </label>
                <textarea
                    id="address"
                    name="address"
                    rows="3"
                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow focus:outline-none focus:ring-2 focus:ring-blue-300"
                    placeholder="123 Main St, Anytown, USA"
                >{{ old('address', $user->address) }}</textarea>
                @error('address')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="role" class="block mb-2 text-sm font-bold text-gray-700">
                    Rol
                </label>
                <select
                    id="role"
                    name="role"
                    class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow focus:outline-none focus:ring-2 focus:ring-blue-300"
                >
                    <option value="">Seleccionar rol</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ (old('role', $user->roles->first()?->name) == $role->name) ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                @error('role')
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
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                >
                    Actualizar usuario
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>

