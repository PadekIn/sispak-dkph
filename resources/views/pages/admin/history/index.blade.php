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
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-2 sm:mb-0">Daftar Riwayat Diagnosa</h3>
                        <div class="datatable-search-container w-full sm:w-auto"></div>
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
                        <table id="history-table" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengguna</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gejala Terpilih</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hasil Diagnosa</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($histories as $history)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-top">
                                            {{ $history->user->name ?? 'User ID: '.$history->user_id }}
                                        </td>
                                        <td class="px-8 py-4 text-sm text-gray-500 align-top" style="width: 150px;">
                                            {{ $history->tanggal ? \Carbon\Carbon::parse($history->tanggal)->format('d-m-Y') : $history->created_at->format('d-m-Y') }}
                                        </td>
                                        <td class="px-8 py-4 text-sm text-gray-700 align-top" style="width: 320px;">
                                            @php
                                                $gejalaNames = json_decode($history->gejala_terpilih, true) ?? [];
                                            @endphp
                                            <div class="flex flex-wrap gap-2">
                                                @foreach($gejalaNames as $gejala)
                                                    <span class="inline-block bg-gray-100 text-gray-800 px-2 py-1 rounded text-xs">
                                                        {{ $gejala }}
                                                    </span>
                                                @endforeach
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
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#history-table').DataTable({
                "pageLength": 10,
                "lengthChange": false,
                "pagingType": "full_numbers",
                "language": {
                    "search": "",
                    "paginate": {
                        "first": "Awal",
                        "last": "Akhir",
                        "next": "&gt;",
                        "previous": "&lt;"
                    },
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "emptyTable": "Belum ada riwayat diagnosa",
                    "zeroRecords": "Data tidak ditemukan"
                }
            });

            $('.dataTables_filter label').contents().filter(function() {
                return this.nodeType === 3;
            }).remove();
            $('.dataTables_filter input')
                .attr('placeholder', 'Cari')
                .after('<span class="search-icon"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24"><path stroke="#b0b7c3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m1.35-5.15a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></span>')
                .on('focus', function() {
                    $(this).attr('placeholder', '');
                })
                .on('blur', function() {
                    if (!$(this).val()) $(this).attr('placeholder', 'Search');
                });
        });
    </script>

    <style>
        .dataTables_wrapper .dataTables_info {
            font-size: 0.85rem !important;
            padding-top: 4px !important;
            padding-bottom: 4px !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            font-size: 0.85rem !important;
            padding: 2px 10px !important;
            margin: 0 2px !important;
            border-radius: 4px !important;
            border: 1px solid #d1d5db !important;
            background: #fff !important;
            color: #374151 !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #374151 !important;
            color: #fff !important;
            border: 1px solid #374151 !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #e5e7eb !important;
            color: #111827 !important;
            border: 1px solid #d1d5db !important;
        }
        .dataTables_wrapper .dataTables_filter {
            width: 100%;
        }
        .dataTables_wrapper .dataTables_filter label {
            display: flex !important;
            align-items: center;
            width: 100%;
            font-size: 0;
            margin-bottom: 8px;
        }
        .dataTables_wrapper .dataTables_filter input {
            width: 100%;
            max-width: 220px;
            height: 28px;
            font-size: 0.95rem;
            padding: 4px 28px 4px 10px;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            color: #6b7280;
            box-sizing: border-box;
            outline: none;
            transition: none;
        }
        .dataTables_wrapper .dataTables_filter input:focus {
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            box-shadow: none;
        }
        .dataTables_wrapper .dataTables_filter .search-icon {
            position: relative;
            left: -24px;
            pointer-events: none;
            color: #b0b7c3;
            font-size: 1rem;
        }
    </style>
</x-admin-layout>


