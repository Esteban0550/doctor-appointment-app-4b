{{--
    Componente: Tabs Container
    Propósito: Contenedor principal que gestiona el estado de las pestañas con Alpine.js
    
    Props:
        - initialTab (string): ID de la pestaña que debe estar activa inicialmente
    
    Uso:
        <x-tabs :initialTab="$initialTab">
            <x-tabs-link tab="tab1" :activeTab="$initialTab">Pestaña 1</x-tabs-link>
            <x-tabs-content tab="tab1">Contenido 1</x-tabs-content>
        </x-tabs>
--}}

@props(['initialTab' => 'tab-1'])

<div x-data="{ activeTab: '{{ $initialTab }}' }">
    {{ $slot }}
</div>

@push('styles')
<style>
    [x-cloak] { display: none !important; }
</style>
@endpush
