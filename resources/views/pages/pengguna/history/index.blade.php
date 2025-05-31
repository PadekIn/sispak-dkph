<x-pengguna-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Histori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="text-gray-600 mb-4">Berikut adalah histori diagnosa Anda.</p>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase w-10">#</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase whitespace-nowrap w-32">Tanggal</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Gejala</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase whitespace-nowrap w-48">Hasil Diagnosa</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($histories as $index => $history)
                                    <tr>
                                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $history->created_at->format('d-m-Y') }}</td>
                                        <td class="px-4 py-2">
                                            @php
                                                $gejalaIds = json_decode($history->gejala_terpilih, true) ?? [];
                                                $gejalas = \App\Models\Gejala::whereIn('id', $gejalaIds)->pluck('nama_gejala')->toArray();
                                            @endphp
                                            @foreach($gejalas as $gejala)
                                                <span class="inline-block bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs mr-1 mb-1">
                                                    {{ $gejala }}
                                                </span>
                                            @endforeach
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ $history->hasil_diagnosa }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-2 text-center text-gray-500">
                                            Belum ada riwayat diagnosa.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-pengguna-layout>
