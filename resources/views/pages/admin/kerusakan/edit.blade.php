<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kerusakan') }}
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

                    <form method="POST" action="{{ route('admin.kerusakan.update', $kerusakans->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Nama Kerusakan -->
                        <div>
                            <x-input-label for="nama_kerusakan" :value="__('Nama Kerusakan')" />
                            <x-text-input id="nama_kerusakan" class="block mt-1 w-full" type="text" name="nama_kerusakan" :value="old('nama_kerusakan', $kerusakans->nama_kerusakan)" required autofocus autocomplete="off" />
                            <x-input-error class="mt-2" :messages="$errors->get('nama_kerusakan')" />
                        </div>

                        <!-- Jenis Kerusakan -->
                        <div class="mt-4">
                            <x-input-label for="jenis_kerusakan" :value="__('Jenis Kerusakan')" />
                            <select id="jenis_kerusakan" name="jenis_kerusakan" class="block mt-1 w-full" required>
                                <option value="">-- Pilih jenis kerusakan --</option>
                                <option value="batre" {{ old('jenis_kerusakan', $kerusakans->jenis_kerusakan) == 'Baterai' ? 'selected' : '' }}>Baterai</option>
                                <option value="lcd" {{ old('jenis_kerusakan', $kerusakans->jenis_kerusakan) == 'LCD' ? 'selected' : '' }}>LCD</option>
                                <option value="konektor_charger" {{ old('jenis_kerusakan', $kerusakans->jenis_kerusakan) == 'Konektor Charger' ? 'selected' : '' }}>Konektor Charger</option>
                                <option value="kamera" {{ old('jenis_kerusakan', $kerusakans->jenis_kerusakan) == 'Kamera' ? 'selected' : '' }}>Kamera</option>
                                <option value="mesin" {{ old('jenis_kerusakan', $kerusakans->jenis_kerusakan) == 'Mesin' ? 'selected' : '' }}>Mesin</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('jenis_kerusakan')" />
                        </div>

                        <!-- Solusi -->
                        <div class="mt-4">
                            <x-input-label for="solusi" :value="__('Solusi')" />
                            <textarea id="solusi" name="solusi" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>{{ old('solusi', $kerusakans->solusi) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('solusi')" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Update Kerusakan') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
