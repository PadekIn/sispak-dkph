<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Selamat datang di Dashboard Admin SISPAK-DKPH</h3>
                    <p>Anda dapat mengelola data kerusakan, gejala, pertanyaan, dan histori diagnosa serta mengelola user di sini.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 mt-6">
                <div class="bg-gray-100 border-l-4 border-gray-400 p-4 rounded shadow flex flex-col justify-center">
                    <div class="text-xs font-medium text-gray-500 tracking-wide uppercase">Jumlah Gejala</div>
                    <div class="text-4xl font-extrabold text-gray-900 mb-1">{{ \App\Models\Gejala::count() }}</div>
                </div>
                <div class="bg-gray-100 border-l-4 border-gray-400 p-4 rounded shadow flex flex-col justify-center">
                    <div class="text-xs font-medium text-gray-500 tracking-wide uppercase">Jumlah Kerusakan</div>
                    <div class="text-4xl font-extrabold text-gray-900 mb-1">{{ \App\Models\Kerusakan::count() }}</div>
                </div>
                <div class="bg-gray-100 border-l-4 border-gray-400 p-4 rounded shadow flex flex-col justify-center">
                    <div class="text-xs font-medium text-gray-500 tracking-wide uppercase">Jumlah User</div>
                    <div class="text-4xl font-extrabold text-gray-900 mb-1">{{ \App\Models\User::count() }}</div>
                </div>
            </div>
    </div>
</x-admin-layout>
