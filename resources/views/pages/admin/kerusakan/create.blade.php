<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kerusakan Baru') }}
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

                    <form method="POST" action="{{ route('admin.kerusakan.store') }}">
                        @csrf

                        <!-- Jenis Kerusakan -->
                        <div class="mt-4">
                            <x-input-label for="jenis_kerusakan" :value="__('Jenis Kerusakan')" />
                            <x-text-input id="jenis_kerusakan" class="block mt-1 w-full" type="text" name="jenis_kerusakan" :value="old('jenis_kerusakan')" required autofocus autocomplete="off" />
                            <x-input-error class="mt-2" :messages="$errors->get('jenis_kerusakan')" />
                        </div>

                        <!-- Solusi -->
                        <div class="mt-4">
                            <x-input-label for="solusi" :value="__('Solusi')" />
                            <textarea id="solusi" name="solusi" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>{{ old('solusi') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('solusi')" />
                        </div>

                        <div class="flex items-center justify-end mt-4 gap-2">
                            <a href="{{ route('admin.kerusakan.index') }}"
                               class="inline-flex items-center px-4 py-2 border border-gray-300 bg-white rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-100 focus:bg-gray-100 active:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Batal
                            </a>
                            <x-primary-button>
                                {{ __('Simpan Kerusakan') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
