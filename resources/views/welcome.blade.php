<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>SISPAK-DKPH - Selamat Datang</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .fade-in {
            animation: fadeInUp 1s ease-out;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="bg-gray-100 to-white min-h-screen flex items-center justify-center px-4">
     <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-md w-full text-center fade-in">
        <img src="{{ asset('assets/img/logo-sispak-dkph.png') }}" alt="Logo SISPAK-DKPH" class="mx-auto mb-6 h-24 drop-shadow-md">

        <h1 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang!</h1>
        <p class="text-sm text-gray-500 mb-6">Sistem Pakar Diagnosa Kerusakan Pada Handphone</p>

        <a href="{{ route('guest.kuesioner') }}"
            class="inline-block px-6 py-3 bg-gray-800 text-white font-semibold rounded-xl shadow-md hover:bg-gray-900 hover:scale-105 transform transition duration-300 ease-in-out">Mulai Kuesioner
        </a>
    </div>
</body>
</html>
