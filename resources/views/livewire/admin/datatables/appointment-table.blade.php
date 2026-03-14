<div class="border border-gray-200 rounded-lg bg-white shadow-sm">
    {{-- Toolbar --}}
    <div class="flex flex-col gap-4 p-4 border-b border-gray-200">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="relative w-full md:w-80">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 1 0 0-15 7.5 7.5 0 0 0 0 15z" />
                    </svg>
                </span>
                <input
                    wire:model.live.debounce.400ms="search"
                    type="search"
                    placeholder="Buscar por paciente o doctor..."
                    class="w-full pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition"
                >
            </div>
            <div class="flex items-center gap-3">
                <div class="text-sm text-gray-500">
                    @if ($appointments->total())
                        Mostrando {{ $appointments->firstItem() }}–{{ $appointments->lastItem() }} de {{ $appointments->total() }} resultados
                    @else
                        No hay citas para mostrar
                    @endif
                </div>
                <select wire:model.live="perPage" class="text-sm border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>
        </div>

        {{-- Filters row --}}
        <div class="flex flex-wrap items-center gap-3">
            <div class="flex items-center gap-2">
                <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha:</label>
                <input
                    wire:model.live="filterDate"
                    type="date"
                    class="text-sm border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400"
                >
            </div>
            <div class="flex items-center gap-2">
                <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">Estado:</label>
                <select
                    wire:model.live="filterStatus"
                    class="text-sm border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400"
                >
                    <option value="">Todos</option>
                    <option value="1">Programado</option>
                    <option value="2">Completado</option>
                    <option value="3">Cancelado</option>
                </select>
            </div>
            @if ($filterDate || $filterStatus !== '')
                <button
                    wire:click="$set('filterDate', ''); $set('filterStatus', '')"
                    class="text-xs text-blue-600 hover:text-blue-800 font-medium"
                >
                    <i class="fa-solid fa-xmark mr-1"></i> Limpiar filtros
                </button>
            @endif
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Paciente</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Doctor</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Fecha</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Hora</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Hora Fin</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Estado</th>
                    <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($appointments as $appointment)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $appointment->id }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                            {{ $appointment->patient->user->name }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                            {{ $appointment->doctor->user->name }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                            {{ $appointment->date->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                            {{ \Illuminate\Support\Str::substr($appointment->start_time, 0, 5) }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">
                            {{ \Illuminate\Support\Str::substr($appointment->end_time, 0, 5) }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            @php
                                $colorMap = [
                                    1 => 'bg-blue-100 text-blue-800',
                                    2 => 'bg-green-100 text-green-800',
                                    3 => 'bg-red-100 text-red-800',
                                ];
                                $color = $colorMap[$appointment->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $color }}">
                                {{ $appointment->status_label }}
                            </span>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.appointments.consultation', $appointment) }}"
                                   class="inline-flex items-center justify-center w-8 h-8 text-white bg-green-500 hover:bg-green-600 rounded-md shadow-sm hover:shadow transition-all duration-150"
                                   title="Atender consulta">
                                    <i class="fa-solid fa-stethoscope text-xs"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-12 text-center text-gray-500">
                            No se encontraron citas médicas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-4 py-3">
        {{ $appointments->links() }}
    </div>
</div>
