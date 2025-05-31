<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Card Total Kerusakan -->
                        <div class="bg-blue-100 p-6 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold text-blue-800">Total Kerusakan</h3>
                            <p class="text-3xl font-bold text-blue-600">{{ \App\Models\Kerusakan::count() }}</p>
                        </div>

                        <!-- Card Total Gejala -->
                        <div class="bg-green-100 p-6 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold text-green-800">Total Gejala</h3>
                            <p class="text-3xl font-bold text-green-600">{{ \App\Models\Gejala::count() }}</p>
                        </div>

                        <!-- Card Total Pertanyaan -->
                        <div class="bg-yellow-100 p-6 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold text-yellow-800">Total Pertanyaan</h3>
                            <p class="text-3xl font-bold text-yellow-600">{{ \App\Models\Pertanyaan::count() }}</p>
                        </div>

                        <!-- Card Total User -->
                        <div class="bg-purple-100 p-6 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold text-purple-800">Total User</h3>
                            <p class="text-3xl font-bold text-purple-600">{{ \App\Models\User::count() }}</p>
                        </div>
                    </div>

                    <!-- Recent History Section -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Riwayat Diagnosa Terbaru</h3>
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hasil</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach(\App\Models\History::with('user')->latest()->take(5)->get() as $history)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $history->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $history->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $history->hasil }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
