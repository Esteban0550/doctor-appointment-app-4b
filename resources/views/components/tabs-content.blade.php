{{--
    Componente: Tabs Content
    Propósito: Contenedor para el contenido de cada pestaña que se muestra/oculta dinámicamente
    
    Props:
        - tab (string): ID único que debe coincidir con el tab del enlace correspondiente
    
    Funcionamiento:
        - x-show: Muestra/oculta el contenido según el valor de activeTab (controlado por Alpine.js)
        - x-cloak: Previene flash de contenido no deseado durante la carga inicial
        - display: none: Estado inicial antes de que Alpine.js tome control
    
    Uso:
        <x-tabs-content tab="datos-personales">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <!-- Tu contenido aquí -->
            </div>
        </x-tabs-content>
        
        <x-tabs-content tab="antecedentes">
            <form>
                <!-- Formulario aquí -->
            </form>
        </x-tabs-content>
--}}

@props(['tab' => ''])

<div x-show="activeTab === '{{ $tab }}'" x-cloak style="display: none;">
    {{ $slot }}
</div>
