<x-pengguna-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hasil Diagnosa') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-8">
                <h3 class="text-lg font-bold mb-4 text-gray-800">Hasil Pengecekan</h3>

                @if(isset($result))
                    <div class="mb-4">
                        <div class="font-semibold text-gray-700 mb-2">Gejala yang dipilih:</div>
                        @if(isset($result['gejala']) && is_array($result['gejala']))
                            <ul class="mb-4">
                                @foreach($result['gejala'] as $gejala)
                                    <li class="mb-1 text-gray-800">- {{ $gejala }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="font-semibold text-gray-700 mb-2">Hasil Diagnosa:</div>
                        <div class="text-indigo-700 font-bold mb-6">
                            {{ $result['hasil_diagnosa'] ?? $result['hasil'] ?? '-' }}
                        </div>
                        <div class="text-sm text-gray-500">
                            Tanggal: {{ $result['tanggal'] ?? '-' }}
                        </div>
                    </div>
                @else
                    <p class="text-gray-500 mb-6">Tidak ada hasil diagnosa yang ditemukan.</p>
                @endif

                <a href="{{ route('pengguna.histori') }}" class="inline-block px-5 py-2 bg-gray-800 text-white rounded hover:bg-gray-600 transition">
                    Cek Histori
                </a>
            </div>
        </div>
    </div>
</x-pengguna-layout>
