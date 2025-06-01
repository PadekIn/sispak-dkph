<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Diagnosa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Daftar Riwayat Diagnosa</h3>
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
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gejala Terpilih</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hasil Diagnosa</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if($histories->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center py-4">Belum ada riwayat diagnosa.</td>
                                    </tr>
                                @else
                                    @foreach ($histories as $history)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $history->user->name ?? 'User ID: '.$history->user_id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <span>
                                                    {{ \Carbon\Carbon::parse($history->tanggal)->format('d-m-Y') }}
                                                </span>
                                            </td>
                                            <td class="px-8 py-4 text-sm text-gray-700 align-top" style="width: 820px;">
                                                @php
                                                    $gejalaIds = json_decode($history->gejala_terpilih, true) ?? [];
                                                    $gejalas = \App\Models\Gejala::whereIn('id', $gejalaIds)->pluck('nama_gejala')->toArray();
                                                @endphp
                                                <div class="flex flex-wrap gap-2">
                                                    @foreach($gejalas as $gejala)
                                                        <span class="inline-block bg-gray-100 text-gray-800 px-2 py-1 rounded text-xs">
                                                            {{ $gejala }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $history->hasil_diagnosa }}
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
</x-admin-layout>


