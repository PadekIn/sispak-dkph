<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>SISPAK-DKPH</title>
        <!-- Favicon -->
        <link rel="shortcut icon" href="./assets/img/logo-sispak-dkph.png" type="image/x-icon">


    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: 'Figtree', sans-serif;
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
    <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-xl w-full text-center fade-in">

        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 mx-auto max-w-sm rounded text-left" role="alert">
                <p class="font-bold">Berhasil!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <img src="{{ asset('assets/img/logo-sispak-dkph.png') }}" alt="Logo SISPAK-DKPH" class="mx-auto mb-6 h-24 drop-shadow-md">

        <h1 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang di SISPAK-DKPH!</h1>
        <p class="text-sm text-gray-700 mb-6"><b>SISPAK-DKPH</b> adalah Sistem Pakar Diagnosa Kerusakan Pada Handphone berbasis web yang dirancang untuk membantu masyarakat dan teknisi dalam mengidentifikasi berbagai jenis kerusakan pada handphone. Aplikasi ini menggunakan metode <i>Forward Chaining</i> untuk memberikan diagnosa berdasarkan gejala yang dialami pengguna.</p>

        <a href="{{ route('guest.diagnosa') }}"
            class="inline-block px-6 py-3 bg-gray-800 text-white font-semibold rounded-xl shadow-md hover:bg-gray-900 hover:scale-105 transform transition duration-300 ease-in-out">Mulai Diagnosa
        </a>
        <div class="mt-4">
            <span class="text-gray-600 text-sm">Sudah punya akun?</span>
            <a href="{{ route('login') }}" class="text-gray-800 hover:underline font-semibold text-sm">Masuk</a>
        </div>
    </div>
</body>
</html>
