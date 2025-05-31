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
                    <p>Anda dapat mengelola data kerusakan, gejala, pertanyaan, dan histori diagnosa di sini.</p>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
