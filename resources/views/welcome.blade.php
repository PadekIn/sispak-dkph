<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Styles / Scripts -->

    </head>
    <body >
        <p class="text-4xl text-blue-500 underline">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

        <div class="bg-red-500 p-8 flex gap-4">
            <div class="bg-green-500 w-3/6">
                <h1 class="text-2xl font-bold text-white">Welcome to Laravel</h1>
            </div>
            <div class="bg-gray-500">
                <h1 class="text-2xl font-bold text-white">Welcome to Laravel</h1>
            </div>
        </div>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>
