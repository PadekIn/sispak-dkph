<x-pengguna-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Histori Diagnosa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Daftar Histori Diagnosa</h3>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border-collapse">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-8 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200">Tanggal</th>
                                    <th class="px-8 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200">Gejala Terpilih</th>
                                    <th class="px-8 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2 border-gray-200">Hasil Diagnosa</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if($histories->isEmpty())
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-gray-500">Belum ada riwayat diagnosa.</td>
                                    </tr>
                                @else
                                    @foreach ($histories as $history)
                                        <tr class="border-b-2 border-gray-200">
                                            <td class="px-8 py-4 text-sm text-gray-500 align-top" style="width: 150px;">
                                                {{ $history->tanggal ? \Carbon\Carbon::parse($history->tanggal)->format('d-m-Y') : $history->created_at->format('d-m-Y') }}
                                            </td>
                                            <td class="px-8 py-4 text-sm text-gray-700 align-top" style="width: 820px;">
                                                @php
                                                    $decodedGejala = json_decode($history->gejala_terpilih, true) ?? [];
                                                    $gejalas = [];

                                                    if (is_array($decodedGejala) && !empty($decodedGejala)) {
                                                        // Cek apakah elemen pertama adalah integer (indikasi ID)
                                                        if (isset($decodedGejala[0]) && is_int($decodedGejala[0])) {
                                                            // Jika ID, ambil nama gejala dari database
                                                            $gejalaIds = $decodedGejala;
                                                            $gejalas = \App\Models\Gejala::whereIn('id', $gejalaIds)->pluck('nama_gejala')->toArray();
                                                        } else {
                                                            // Jika bukan ID, asumsikan sudah dalam bentuk nama gejala
                                                            $gejalas = $decodedGejala;
                                                        }
                                                    }
                                                @endphp
                                                <div class="flex flex-wrap gap-2">
                                                    @if(is_array($gejalas))
                                                    @foreach($gejalas as $gejala)
                                                        <span class="inline-block bg-gray-100 text-gray-800 px-2 py-1 rounded text-xs">
                                                            {{ $gejala }}
                                                        </span>
                                                    @endforeach
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-8 py-4 text-sm text-gray-700 w-auto align-top">
                                                @php
                                                    $hasilDiagnosa = json_decode($history->hasil_diagnosa, true);
                                                @endphp

                                                @if(is_array($hasilDiagnosa))
                                                    <ul class="list-none pl-0 space-y-2">
                                            @foreach($hasilDiagnosa as $item)
                                                @php
                                                    $kerusakan = $item['kerusakan'] ?? $item;
                                                    $match = $item['match'] ?? null;
                                                    $total = $item['total'] ?? null;

                                                    $confidence = '-';
                                                    $badgeClass = 'bg-gray-300 text-gray-800';

                                                    if (is_numeric($match) && is_numeric($total) && $total > 0) {
                                                        $persen = ($match / $total) * 100;

                                                        if ($persen == 100) {
                                                            $confidence = '';
                                                            $badgeClass = 'bg-red-100 text-red-800';
                                                        } elseif ($persen >= 50) {
                                                            $confidence = '';
                                                            $badgeClass = 'bg-yellow-100 text-yellow-800';
                                                        } else {
                                                            $confidence = '';
                                                            $badgeClass = 'bg-green-100 text-green-800';
                                                        }
                                                    }
                                                @endphp

                                                <li class="border-b-2 border-gray-200">
                                                    <div class="flex flex-wrap items-center gap-2">
                                                        {{-- <span class="font-medium">{{ $kerusakan }}</span> --}}
                                                        @if($match !== null && $total !== null)
                                                            @php
                                                                $persen = round(($match / $total) * 100, 0);
                                                            @endphp
                                                            <span class="font-minimum">
                                                                Terindikasi
                                                                <span class="font-bold text-gray-800 {{ $badgeClass }}">
                                                                {{ $persen }}%
                                                                </span>
                                                                Kerusakan Pada
                                                                <span class="font-bold text-gray-800">
                                                                    {{ $kerusakan }}
                                                                </span>
                                                            </span>
                                                            {{-- <span class="text-xs px-2 py-1 rounded {{ $badgeClass }}">
                                                                {{ $confidence }}
                                                            </span> --}}
                                                        @endif
                                                    </div>
                                                </li>
                                            @endforeach

                                                    </ul>
                                                @else
                                                    {{ $history->hasil_diagnosa }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-pengguna-layout>
