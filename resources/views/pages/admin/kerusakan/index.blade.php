<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Kerusakan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-2 sm:mb-0">Daftar Kerusakan</h3>
                        <div class="flex items-center gap-2 w-full sm:w-auto">
                            <a href="{{ route('admin.kerusakan.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Tambah Kerusakan
                            </a>
                            <div class="datatable-search-container w-full sm:w-auto"></div>
                        </div>
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
                        <table id="kerusakan-table" class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kerusakan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Solusi</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($kerusakans as $kerusakan)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $kerusakan->jenis_kerusakan }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $kerusakan->solusi }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify gap-3">
                                                <a href="{{ route('admin.kerusakan.edit', $kerusakan->id) }}" class="text-indigo-600 hover:text-indigo-900">Ubah</a>
                                                <button type="button"
                                                    class="text-red-600 hover:text-red-900"
                                                    onclick="confirmHapus('{{ route('admin.kerusakan.destroy', $kerusakan->id) }}')">
                                                    Hapus
                                                </button>
                                            </div>
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

    <x-modal name="hapus-modal">
        <div class="p-6">
            <div class="flex justify-between items-center mb-2">
                <h2 class="text-lg font-semibold text-gray-800">Konfirmasi Hapus</h2>
                <button type="button"
                    onclick="window.dispatchEvent(new CustomEvent('close-modal', {detail: 'hapus-modal'}))"
                    class="text-gray-400 hover:text-gray-700 transition"
                    aria-label="Tutup">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <p class="mb-4 text-gray-600">Apakah Anda yakin ingin menghapus kerusakan ini?</p>
            <div class="flex justify-end gap-2">
                <button type="button"
                    onclick="window.dispatchEvent(new CustomEvent('close-modal', {detail: 'hapus-modal'}))"
                    class="inline-flex items-center px-4 py-2 border-gray-800 bg-white border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-200 focus:bg-gray-200 active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Batal
                </button>
                <form id="form-hapus" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </x-modal>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
        function confirmHapus(url) {
            document.getElementById('form-hapus').setAttribute('action', url);
            window.dispatchEvent(new CustomEvent('open-modal', {detail: 'hapus-modal'}));
        }

        $(document).ready(function() {
            $('#kerusakan-table').DataTable({
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
                    "emptyTable": "Belum ada data kerusakan.",
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
