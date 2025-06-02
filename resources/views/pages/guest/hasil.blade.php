<x-guest-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Hasil Diagnosa</h2>

                        @if(isset($result))
                            <div class="mb-6">
                                <div class="font-semibold text-gray-700 mb-2">Gejala yang dipilih:</div>
                                @if(isset($result['gejala']) && is_array($result['gejala']))
                                    <ul class="mb-4">
                                        @foreach($result['gejala'] as $gejala)
                                            <li class="mb-1 text-gray-800">- {{ $gejala }}</li>
                                        @endforeach
                                    </ul>
                                @endif

                                <div class="font-semibold text-gray-700 mb-2">Hasil Diagnosa:</div>
                                @if(is_array($result['hasil_diagnosa']))
                                    <ul class="mb-6">
                                        @foreach($result['hasil_diagnosa'] as $diagnosa)
                                            <li class="mb-2 text-gray-800">
                                                @if(isset($diagnosa['match']) && isset($diagnosa['total']))
                                                    @php
                                                        $matchPercentage = ($diagnosa['match'] / $diagnosa['total']) * 100;
                                                    @endphp
                                                    <span class="font-bold">
                                                        {{ $diagnosa['kerusakan'] }}
                                                    </span>
                                                    <span class="text-sm text-gray-600">
                                                        (Terindikasi {{ number_format($matchPercentage) }}% kerusakan)
                                                    </span>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                                <div class="text-sm text-gray-500 mb-6">
                                    Tanggal: {{ $result['tanggal'] ?? '-' }}
                                </div>

                                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm text-yellow-700">
                                                Hasil diagnosa ini belum disimpan. Silakan masuk untuk menyimpan hasil diagnosa Anda.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex space-x-4">
                                    <button onclick="window.dispatchEvent(new CustomEvent('open-modal', {detail: 'login-modal'}))" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Masuk untuk Menyimpan
                                    </button>
                                    <a href="{{ route('guest.diagnosa') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Diagnosa Baru
                                    </a>
                                </div>
                            </div>
                        @else
                            <p class="text-gray-500">Tidak ada hasil diagnosa yang ditemukan.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
