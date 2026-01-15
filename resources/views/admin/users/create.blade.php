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
                    <label for="id_number" class="block mb-2 text-sm font-bold text-gray-700">
                        Número de ID
                    </label>
                    <input
                        type="text"
                        id="id_number"
                        name="id_number"
                        value="{{ old('id_number') }}"
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
                        value="{{ old('phone') }}"
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
                >{{ old('address') }}</textarea>
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
                        <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
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
                    class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-lg text-sm font-semibold text-white hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors duration-150"
                >
                    Cancelar
                </a>
                <button
                    type="submit"
                    class="inline-flex items-center px-5 py-2.5 bg-gray-500 border border-transparent rounded-lg text-sm font-semibold text-white hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition-colors duration-150"
                >
                    Guardar usuario
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>

