<x-admin-layout
    title="Crear Usuario"
    :breadcrumbs="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['name' => 'Usuarios', 'url' => route('admin.users.index')],
        ['name' => 'Crear'],
    ]"
>
    <div class="max-w-5xl mx-auto">
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Columna Izquierda -->
                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-semibold text-gray-700">
                                Nombre
                            </label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Nombre"
                                class="w-full px-3 py-2 text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                required
                            >
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block mb-2 text-sm font-semibold text-gray-700">
                                Contraseña
                            </label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Mínimo 8 caracteres"
                                class="w-full px-3 py-2 text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                required
                            >
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="id_number" class="block mb-2 text-sm font-semibold text-gray-700">
                                Número de ID
                            </label>
                            <input
                                type="text"
                                id="id_number"
                                name="id_number"
                                value="{{ old('id_number') }}"
                                placeholder="Ej. 123456789"
                                class="w-full px-3 py-2 text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            >
                            @error('id_number')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Columna Derecha -->
                    <div class="space-y-6">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-semibold text-gray-700">
                                Email
                            </label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Email"
                                class="w-full px-3 py-2 text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                required
                            >
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block mb-2 text-sm font-semibold text-gray-700">
                                Confirmar contraseña
                            </label>
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="Repita la contraseña"
                                class="w-full px-3 py-2 text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                required
                            >
                        </div>

                        <div>
                            <label for="phone" class="block mb-2 text-sm font-semibold text-gray-700">
                                Teléfono
                            </label>
                            <input
                                type="text"
                                id="phone"
                                name="phone"
                                value="{{ old('phone') }}"
                                placeholder="Ej. 123456789"
                                class="w-full px-3 py-2 text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            >
                            @error('phone')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Campos de ancho completo -->
                <div class="space-y-6 mt-6">
                    <div>
                        <label for="address" class="block mb-2 text-sm font-semibold text-gray-700">
                            Dirección
                        </label>
                        <input
                            type="text"
                            id="address"
                            name="address"
                            value="{{ old('address') }}"
                            placeholder="Ej. Calle 123"
                            class="w-full px-3 py-2 text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        >
                        @error('address')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="role" class="block mb-2 text-sm font-semibold text-gray-700">
                            Rol
                        </label>
                        <select
                            id="role"
                            name="role"
                            class="w-full px-3 py-2 text-gray-900 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        >
                            <option value="">Seleccione un rol</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-gray-500">Define los permisos y accesos del usuario</p>
                        @error('role')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button
                        type="submit"
                        class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>

