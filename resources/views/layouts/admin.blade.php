<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="simifibra" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=inter:400,600&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-300" style="background-image: url('{{ asset('metriass 4to/back/tu-imagen.jpg') }}'); background-size: cover; background-repeat: no-repeat; background-position: center;">

@include('layouts.includes.admin.navigation')

@include('layouts.includes.admin.sidebar')

<div class="p-4 sm:ml-64">
    <div class="mt-14">
        {{$slot}}
    </div>
</div>

@stack('modals')

@livewireScripts

<script src="https://cdn.jsdelivr.net/npm/estasimi@latest/dist/estasimi.min.js"></script>
<script src="https://kit.fontawesome.com/337049a37c.js" crossorigin="anonymous"></script>

</body>
</html>
