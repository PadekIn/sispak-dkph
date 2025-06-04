<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Gejala Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

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

                    <form method="POST" action="{{ route('admin.gejala.store') }}">
                        @csrf

                        <!-- Kode Gejala -->
                        <div>
                            <x-input-label for="kerusakan_id" :value="__('Nama Kerusakan')" />
                            <select id="kerusakan_id" name="kerusakan_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option selected hidden>Silakan Pilih kategori kerusakan</option>
                                @foreach ($kerusakans as $kerusakan)
                                    <option value="{{ $kerusakan->id}}">{{ $kerusakan->jenis_kerusakan }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('kode_gejala')" />
                        </div>

                        <!-- Nama Gejala -->
                        <div class="mt-4">
                            <x-input-label for="nama_gejala" :value="__('Nama Gejala')" />
                            <x-text-input id="nama_gejala" class="block mt-1 w-full" type="text" name="nama_gejala" :value="old('nama_gejala')" required autocomplete="off" />
                            <x-input-error class="mt-2" :messages="$errors->get('nama_gejala')" />
                        </div>

                        <div class="flex items-center justify-end mt-4 gap-2">
                            <a href="{{ route('admin.gejala.index') }}"
                               class="inline-flex items-center px-4 py-2 border border-gray-300 bg-white rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-100 focus:bg-gray-100 active:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Batal
                            </a>
                            <x-primary-button>
                                {{ __('Simpan Gejala') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
