<x-pengguna-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hasil Diagnosa') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-8">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <h3 class="text-lg font-bold mb-4 text-gray-800">Hasil Pengecekan</h3>

                @if(isset($result) || session('result'))
                    @php
                        $currentResult = $result ?? session('result');
                    @endphp
                    <div class="mb-4">
                        <div class="font-semibold text-gray-700 mb-2">Gejala yang dipilih:</div>
                        @if(isset($currentResult['gejala']) && is_array($currentResult['gejala']))
                            <ul class="mb-4">
                                @foreach($currentResult['gejala'] as $gejala)
                                    <li class="mb-1 text-gray-800">- {{ $gejala }}</li>
                                @endforeach
                            </ul>
                        @endif
                            <div class="font-semibold text-gray-700 mb-2">Hasil Diagnosa:</div>

                            @if(is_array($currentResult['hasil_diagnosa']))
                                <ul class="mb-6">
                                    @foreach($currentResult['hasil_diagnosa'] as $diagnosa)
                                        <li class="mb-2 text-gray-800">
                                            - {{ $diagnosa['kerusakan'] ?? $diagnosa }}
                                            @if(isset($diagnosa['match']) && isset($diagnosa['total']))
                                            @php
                                                $matchPercentage = ($diagnosa['match'] / $diagnosa['total']) * 100;
                                            @endphp
                                                <span class="text-sm text-gray-600">
                                                    (Terindikasi {{ number_format($matchPercentage) }}% kerusakan pada {{ $diagnosa['kerusakan'] ?? $diagnosa }})
                                                </span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="text-indigo-700 font-bold mb-6">
                                    {{ $currentResult['hasil_diagnosa'] }}
                                </div>
                            @endif
                        <div class="text-sm text-gray-500">
                            Tanggal: {{ $currentResult['tanggal'] ?? '-' }}
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
