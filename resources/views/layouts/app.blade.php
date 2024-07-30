<!DOCTYPE html>
<html dir="{{ app()->getLocale() == 'ar' ? 'rtl' : '' }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.phoenix.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    @if (config('filament.assets'))
        @filamentStyles
    @endif
</head>


<body>
    <div class="p-4 sm:ml-64 rtl:sm:mr-64 rtl:sm:ml-0">
        <x-dashboard.navbar></x-dashboard.navbar>
        <x-dashboard.Sidebar></x-dashboard.Sidebar>

        <div class="mt-8">

            {{ $slot }}
        </div>

    </div>

    @livewireScripts
        @if (config('filament.assets'))
            @filamentStyles
        @endif
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        @stack('script')
</body>

</html>
