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
                        <button type="button" onclick="window.dispatchEvent(new CustomEvent('open-modal', {detail: 'login-modal'}))" class="inline-flex items-center mt-4 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Kirim Diagnosa
                        </button>
                    </form>

                    <x-modal name="login-modal">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-2">
                                <h2 class="text-lg font-semibold text-gray-800">Login Diperlukan</h2>
                                <button type="button"
                                    onclick="window.dispatchEvent(new CustomEvent('close-modal', {detail: 'login-modal'}))"
                                    class="text-gray-400 hover:text-gray-700 transition"
                                    aria-label="Tutup">
                                    <!-- Heroicons X Mark (Exit) -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <p class="mb-4 text-gray-600">Anda harus login terlebih dahulu untuk mengirim diagnosa.</p>
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('register') }}" class="inline-flex items-center mt-4 px-4 py-2 border-gray-800 bg-white border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Registrasi</a>
                                <a href="{{ route('login') }}" class="inline-flex items-center mt-4 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Login</a>
                            </div>
                        </div>
                    </x-modal>

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
