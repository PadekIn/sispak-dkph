<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Gejala') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Daftar Gejala</h3>
                        <a href="{{ route('admin.gejala.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Tambah Gejala
                        </a>
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
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Gejala</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($gejalas as $gejala)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $gejala->kode_gejala }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $gejala->nama_gejala }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('admin.gejala.edit', $gejala->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                            <button type="button"
                                                class="text-red-600 hover:text-red-900"
                                                onclick="confirmHapusGejala('{{ route('admin.gejala.destroy', $gejala->id) }}')">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4">Belum ada data gejala.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($gejalas->isEmpty())
                        <p class="text-gray-600 mt-4">Belum ada gejala yang terdaftar.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <x-modal name="hapus-gejala-modal">
        <div class="p-6">
            <div class="flex justify-between items-center mb-2">
                <h2 class="text-lg font-semibold text-gray-800">Konfirmasi Hapus</h2>
                <button type="button"
                    onclick="window.dispatchEvent(new CustomEvent('close-modal', {detail: 'hapus-gejala-modal'}))"
                    class="text-gray-400 hover:text-gray-700 transition"
                    aria-label="Tutup">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <p class="mb-4 text-gray-600">Apakah Anda yakin ingin menghapus gejala ini?</p>
            <div class="flex justify-end gap-2">
                <button type="button"
                    onclick="window.dispatchEvent(new CustomEvent('close-modal', {detail: 'hapus-gejala-modal'}))"
                    class="inline-flex items-center px-4 py-2 border-gray-800 bg-white border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-200 focus:bg-gray-200 active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Batal
                </button>
                <form id="form-hapus-gejala" method="POST">
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

    <script>
        function confirmHapusGejala(url) {
            document.getElementById('form-hapus-gejala').setAttribute('action', url);
            window.dispatchEvent(new CustomEvent('open-modal', {detail: 'hapus-gejala-modal'}));
        }
    </script>
</x-admin-layout>
