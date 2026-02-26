{{--
    Componente: Tabs Link
    Propósito: Enlace de navegación individual para cada pestaña con estilos dinámicos
    
    Props:
        - tab (string): ID único de esta pestaña
        - activeTab (string): ID de la pestaña actualmente activa
        - icon (string, opcional): Nombre del ícono de FontAwesome (sin prefijo fa-)
        - hasError (bool, default:false): Indica si esta pestaña tiene errores de validación
    
    Estados visuales:
        1. Activa sin error: azul
        2. Activa con error: roja
        3. Inactiva sin error: gris con hover
        4. Inactiva con error: roja sin borde activo
    
    Uso:
        <x-tabs-link tab="datos-personales" :activeTab="$initialTab" icon="user">
            Datos Personales
        </x-tabs-link>
        
        <x-tabs-link 
            tab="antecedentes" 
            :activeTab="$initialTab" 
            icon="file-lines"
            :hasError="$errors->hasAny(['allergies', 'chronic_conditions'])"
        >
            Antecedentes
        </x-tabs-link>
--}}

@props([
    'tab' => '',
    'activeTab' => '',
    'icon' => '',
    'hasError' => false
])

@php
    // Clases base (siempre se aplican)
    $baseClasses = 'inline-flex items-center justify-center p-4 border-b-2 rounded-t-lg transition-colors duration-200';
@endphp

<li class="me-2">
    <a 
        href="#" 
        @click.prevent="activeTab = '{{ $tab }}'"
        {{-- Alpine.js binding reactivo: actualiza clases cuando activeTab cambia --}}
        :class="activeTab === '{{ $tab }}' 
            ? '{{ $hasError ? 'text-red-600 border-red-600 dark:text-red-500 dark:border-red-500' : 'text-blue-600 border-blue-600 dark:text-blue-500 dark:border-blue-500' }}' 
            : '{{ $hasError ? 'text-red-600 border-transparent dark:text-red-500' : 'text-gray-500 hover:text-blue-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 border-transparent' }}'"
        class="{{ $baseClasses }}"
    >
        {{-- Ícono opcional --}}
        @if($icon)
            <i class="fa-solid fa-{{ $icon }} mr-2"></i>
        @endif
        
        {{-- Texto del enlace --}}
        {{ $slot }}
        
        {{-- Indicador de error animado --}}
        @if($hasError)
            <i class="fa-solid fa-circle-exclamation ms-2 animate-pulse"></i>
        @endif
    </a>
</li>
