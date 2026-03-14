<x-admin-layout
    title="Horarios"
    :breadcrumbs="[
        ['name' => 'Dashboard', 'href' => route('admin.dashboard')],
        ['name' => 'Doctores',  'href' => route('admin.doctors.index')],
        ['name' => 'Horarios'],
    ]"
>
    @php
        $days  = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        $hours = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'];
    @endphp

    <div
        x-data="{
            selectedSlots: {},
            key(d, h, s) { return d + '_' + h + '_' + s; },
            isChecked(d, h, s) { return !!this.selectedSlots[this.key(d, h, s)]; },
            toggle(d, h, s) {
                const k = this.key(d, h, s);
                this.selectedSlots[k] = !this.selectedSlots[k];
            },
            isAllDayHour(d, h) {
                for (let s = 0; s < 4; s++) {
                    if (!this.selectedSlots[this.key(d, h, s)]) return false;
                }
                return true;
            },
            toggleAllDayHour(d, h) {
                const all = this.isAllDayHour(d, h);
                for (let s = 0; s < 4; s++) {
                    this.selectedSlots[this.key(d, h, s)] = !all;
                }
            },
            isAllHour(h) {
                for (let d = 0; d < {{ count($days) }}; d++) {
                    for (let s = 0; s < 4; s++) {
                        if (!this.selectedSlots[this.key(d, h, s)]) return false;
                    }
                }
                return true;
            },
            toggleAllHour(h) {
                const all = this.isAllHour(h);
                for (let d = 0; d < {{ count($days) }}; d++) {
                    for (let s = 0; s < 4; s++) {
                        this.selectedSlots[this.key(d, h, s)] = !all;
                    }
                }
            },
            save() {
                Swal.fire({ icon: 'success', title: 'Horario guardado', text: 'Los horarios han sido actualizados.' });
            }
        }"
        class="bg-white rounded-lg shadow-lg p-6"
    >
        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-900">Gestor de horarios</h2>
                <p class="text-sm text-gray-600 mt-1">Dr. {{ $doctor->user->name }}</p>
            </div>
            <button
                @click="save()"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow transition-colors"
            >
                Guardar horario
            </button>
        </div>

        {{-- Grid --}}
        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-xs">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="px-3 py-2 text-left text-xs font-semibold text-gray-600 uppercase w-28">DÍA/HORA</th>
                        @foreach ($days as $dayIndex => $day)
                            <th class="px-2 py-2 text-center text-xs font-semibold text-gray-600 uppercase min-w-[110px]">
                                {{ strtoupper($day) }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hours as $hourIndex => $hour)
                        @php
                            $nextHour = sprintf('%02d:00', (int) $hour + 1);
                            $slots    = [
                                "{$hour} - " . Carbon\Carbon::createFromFormat('H:i', $hour)->addMinutes(15)->format('H:i'),
                                Carbon\Carbon::createFromFormat('H:i', $hour)->addMinutes(15)->format('H:i') . ' - ' . Carbon\Carbon::createFromFormat('H:i', $hour)->addMinutes(30)->format('H:i'),
                                Carbon\Carbon::createFromFormat('H:i', $hour)->addMinutes(30)->format('H:i') . ' - ' . Carbon\Carbon::createFromFormat('H:i', $hour)->addMinutes(45)->format('H:i'),
                                Carbon\Carbon::createFromFormat('H:i', $hour)->addMinutes(45)->format('H:i') . ' - ' . Carbon\Carbon::createFromFormat('H:i', $hour)->addMinutes(60)->format('H:i'),
                            ];
                        @endphp
                        <tr class="border-b border-gray-100">
                            {{-- Hour label + master checkbox --}}
                            <td class="px-3 py-2 align-top">
                                <label class="flex items-center gap-1 cursor-pointer text-gray-700 font-medium">
                                    <input
                                        type="checkbox"
                                        :checked="isAllHour({{ $hourIndex }})"
                                        @change="toggleAllHour({{ $hourIndex }})"
                                        class="rounded border-gray-300 text-blue-600"
                                    >
                                    {{ $hour }}:00
                                </label>
                            </td>
                            {{-- Day columns --}}
                            @foreach ($days as $dayIndex => $day)
                                <td class="px-2 py-1 align-top border-l border-gray-100">
                                    {{-- "Todos" for this day/hour --}}
                                    <label class="flex items-center gap-1 cursor-pointer text-gray-500 mb-1">
                                        <input
                                            type="checkbox"
                                            :checked="isAllDayHour({{ $dayIndex }}, {{ $hourIndex }})"
                                            @change="toggleAllDayHour({{ $dayIndex }}, {{ $hourIndex }})"
                                            class="rounded border-gray-300 text-blue-600"
                                        >
                                        Todos
                                    </label>
                                    {{-- 15-min slots --}}
                                    @foreach ($slots as $slotIndex => $slotLabel)
                                        <label class="flex items-center gap-1 cursor-pointer text-gray-600 mb-0.5">
                                            <input
                                                type="checkbox"
                                                :checked="isChecked({{ $dayIndex }}, {{ $hourIndex }}, {{ $slotIndex }})"
                                                @change="toggle({{ $dayIndex }}, {{ $hourIndex }}, {{ $slotIndex }})"
                                                class="rounded border-gray-300 text-blue-600"
                                            >
                                            <span class="text-xs">{{ $slotLabel }}</span>
                                        </label>
                                    @endforeach
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
