<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SISPAK-DKPH</title>
        <!-- Favicon -->
        <link rel="shortcut icon" href="./assets/img/logo-sispak-dkph.png" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-100 min-h-screen flex flex-col justify-center items-center py-6">
        <div class="w-full max-w-md mx-auto">

            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/img/logo-sispak-dkph.png') }}" alt="Logo SISPAK-DKPH" class="h-16 w-auto drop-shadow-md">
                </a>
            </div>

            <!-- Page Content -->
            <div class="bg-white shadow-xl rounded-lg px-8 py-8">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
