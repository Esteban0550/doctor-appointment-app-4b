<<<<<<< HEAD
@props([
    'title' => config('app.name', 'Laravel'),
    'breadcrumbs' => []
])
=======
>>>>>>> f9689e724ba3b4b63b9b4acf46f2624d56b2a423
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

<<<<<<< HEAD
        <title>{{ $title }}</title>
=======
        <title>{{ config('app.name', 'Laravel') }}</title>
>>>>>>> f9689e724ba3b4b63b9b4acf46f2624d56b2a423

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://kit.fontawesome.com/a7de8752fc.js" crossorigin="anonymous"></script>

<<<<<<< HEAD
        <wireui:scripts />
        {{-- Livewire Scripts --}}
        @livewireScripts

=======
>>>>>>> f9689e724ba3b4b63b9b4acf46f2624d56b2a423
        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-gray-50">
        @include('layouts.includes.admin.navigation')

        @include('layouts.includes.admin.sidebar')

        <div class="p-4 sm:ml-64">
            <!-- Margin top 14px -->
            <div class="mt-14">
<<<<<<< HEAD
                @include('layouts.includes.admin.breadcrumb')
=======
>>>>>>> f9689e724ba3b4b63b9b4acf46f2624d56b2a423
                {{ $slot }}
            </div>
        </div>

        @stack('modals')
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

<<<<<<< HEAD
    </body>
=======
        {{-- WireUI Scripts --}}
        <wireui:scripts />
        {{-- Livewire Scripts --}}
        @livewireScripts
    </body>
>>>>>>> f9689e724ba3b4b63b9b4acf46f2624d56b2a423
