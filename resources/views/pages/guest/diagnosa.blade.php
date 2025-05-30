<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Diagnosa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="text-gray-600 mb-4">Silakan pilih gejala yang Anda alami:</p>

                    <form method="POST" action="{{ route('guest.diagnosa.submit') }}">
                        @csrf
                        @foreach ($gejalas as $gejala)
                            <div class="flex items-center mb-2">
                                <input id="gejala-{{ $gejala->id }}" name="gejala[]" type="checkbox" value="{{ $gejala->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500">
                                <label for="gejala-{{ $gejala->id }}" class="ms-2 text-sm font-medium text-gray-900">{{ $gejala->nama_gejala }}</label>
                            </div>
                        @endforeach
                        <x-primary-button class="mt-4">
                            {{ __('Kirim Diagnosa') }}
                        </x-primary-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
