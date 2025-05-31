<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- <title>{{ config('app.name', 'SISPAK_DKPH') }}</title> -->
        <title>SISPAK-DKPH</title>
        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/img/logo-sispak-dkph.png') }}" type="image/x-icon">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-white min-h-screen flex">
        @include('layouts.admin-navigation')
        <!-- Main Content -->
        <main class="flex-1 min-h-screen bg-gray-50 p-8">
            @isset($header)
                <h1 class="text-2xl font-bold mb-6 text-gray-800">
                    {{ $header }}
                </h1>
            @endisset
            <div class="bg-white rounded-xl shadow p-8">
                {{ $slot }}
            </div>
        </main>
    </body>
</html>
