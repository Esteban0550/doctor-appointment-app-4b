<x-admin-layout
    title="Calendario"
    :breadcrumbs="[
        ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
        ['name' => 'Calendario'],
    ]"
>
    <section class="p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-lg">
        <div class="flex flex-col gap-4 mb-6 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Calendario
                </h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Vista mensual de las citas médicas (versión de solo lectura).
                </p>
            </div>

            <div class="flex items-center gap-3">
                <button
                    type="button"
                    class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600 dark:hover:bg-gray-600"
                >
                    Hoy
                </button>
                <div class="inline-flex rounded-lg shadow-sm bg-white border border-gray-200 overflow-hidden text-sm dark:bg-gray-800 dark:border-gray-700">
                    <button class="px-3 py-2 text-gray-600 hover:bg-gray-50 dark:text-gray-200 dark:hover:bg-gray-700">
                        Mes
                    </button>
                    <button class="px-3 py-2 text-gray-400 border-l border-gray-200 dark:border-gray-700 dark:text-gray-500">
                        Semana
                    </button>
                    <button class="px-3 py-2 text-gray-400 border-l border-gray-200 dark:border-gray-700 dark:text-gray-500">
                        Día
                    </button>
                    <button class="px-3 py-2 text-gray-400 border-l border-gray-200 dark:border-gray-700 dark:text-gray-500">
                        Lista
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden dark:bg-gray-900">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-3">
                    <button class="p-1.5 text-gray-500 rounded hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <button class="p-1.5 text-gray-500 rounded hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-800">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                        marzo de 2026
                    </h2>
                </div>
            </div>

            {{-- Grid de calendario estático solo para la maqueta --}}
            <div class="grid grid-cols-7 text-xs border-t border-gray-200 dark:border-gray-700">
                @php
                    $weekdays = ['dom', 'lun', 'mar', 'mié', 'jue', 'vie', 'sáb'];
                @endphp
                @foreach ($weekdays as $day)
                    <div class="px-3 py-2 text-center font-semibold text-gray-500 uppercase tracking-wide bg-gray-50 dark:bg-gray-800 dark:text-gray-400">
                        {{ $day }}
                    </div>
                @endforeach
            </div>

            <div class="grid grid-cols-7 grid-rows-6 border-t border-gray-200 text-xs dark:border-gray-700">
                @for ($cell = 0; $cell < 42; $cell++)
                    @php
                        // Marzo 2026 empieza en domingo (0) y tiene 31 días
                        $dayNumber = $cell - 0 + 1;
                    @endphp
                    <div class="min-h-[90px] border-b border-r border-gray-200 p-1.5 align-top dark:border-gray-700">
                        @if ($dayNumber > 0 && $dayNumber <= 31)
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-[11px] font-semibold text-gray-700 dark:text-gray-200">
                                    {{ $dayNumber }}
                                </span>
                            </div>

                            {{-- Eventos de ejemplo estáticos, solo para que la UI se parezca a la maqueta --}}
                            @if (in_array($dayNumber, [3, 7, 10, 12, 15, 19]))
                                <div class="space-y-1">
                                    <span class="block px-2 py-0.5 rounded bg-green-100 text-[11px] text-green-800 truncate">
                                        09:30 Paciente Demo 9
                                    </span>
                                    <span class="block px-2 py-0.5 rounded bg-blue-100 text-[11px] text-blue-800 truncate">
                                        15:30 Paciente Demo 5
                                    </span>
                                </div>
                            @endif
                        @endif
                    </div>
                @endfor
            </div>
        </div>
    </section>
</x-admin-layout>

