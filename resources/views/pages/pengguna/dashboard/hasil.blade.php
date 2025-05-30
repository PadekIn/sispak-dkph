<x-pengguna-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hasil Diagnosa') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-8">
                <h3 class="text-lg font-bold mb-4 text-gray-800">Hasil Pengecekan</h3>

                @if(isset($hasil) && count($hasil))
                    <ul class="mb-6">
                        @foreach($hasil as $item)
                            <li class="mb-2 flex items-center">
                                <span class="inline-block w-2 h-2 bg-gray-200 rounded-full mr-2"></span>
                                <span class="text-gray-800">{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 mb-6">Tidak ada hasil diagnosa yang ditemukan.</p>
                @endif

                <a href="{{ route('pengguna.diagnosa') }}" class="inline-block px-5 py-2 bg-gray-800 text-white rounded hover:bg-gray-600 transition">
                    Kembali ke Diagnosa
                </a>
            </div>
        </div>
    </div>
</x-pengguna-layout>
