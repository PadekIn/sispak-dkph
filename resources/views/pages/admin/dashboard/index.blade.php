<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center mb-2">
                        <svg class="w-7 h-7 text-gray-600 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 20c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8z" />
                        </svg>
                        <h3 class="text-2xl font-bold text-gray-800 drop-shadow-sm">
                            Selamat datang di Beranda Admin <span class="font-semibold text-gray-600">SISPAK-DKPH</span>
                        </h3>
                    </div>
                    <p class="text-gray-500 text-base">Anda dapat mengelola data kerusakan, gejala, dan histori diagnosa serta mengelola pengguna di sini.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 mt-6">
                <div class="bg-gray-100 border-l-4 border-gray-400 p-4 rounded shadow flex flex-col justify-center">
                    <div class="text-xs font-medium text-gray-500 tracking-wide uppercase">Jumlah Gejala</div>
                    <div class="text-4xl font-extrabold text-gray-900 mb-1">{{ \App\Models\Gejala::count() }}</div>
                </div>
                <div class="bg-gray-100 border-l-4 border-gray-400 p-4 rounded shadow flex flex-col justify-center">
                    <div class="text-xs font-medium text-gray-500 tracking-wide uppercase">Jumlah Kerusakan</div>
                    <div class="text-4xl font-extrabold text-gray-900 mb-1">{{ \App\Models\Kerusakan::count() }}</div>
                </div>
                <div class="bg-gray-100 border-l-4 border-gray-400 p-4 rounded shadow flex flex-col justify-center">
                    <div class="text-xs font-medium text-gray-500 tracking-wide uppercase">Jumlah User</div>
                    <div class="text-4xl font-extrabold text-gray-900 mb-1">{{ \App\Models\User::count() }}</div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-1">
                <div class="bg-white rounded shadow p-6 flex flex-col items-center relative w-full" style="min-height: 400px;">
                    <div class="absolute right-6 top-6 z-10">
                        <div class="relative inline-block text-left">
                            <button id="btnFilterBulanTahun" type="button" class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-sm font-medium rounded text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Filter
                                <svg class="w-4 h-4 ml-2 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div id="dropdownBulanTahun" class="origin-top-right absolute right-0 mt-2 w-44 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden z-20">
                                <div class="py-1" id="dropdownBulanTahunList">
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="text-lg font-semibold mb-4 text-center w-full">Grafik Diagnosa Kerusakan per Bulan</h4>
                    <div class="w-full flex justify-center items-center relative" style="height:400px;">
                        <canvas id="dataKerusakanPerBulan" style="width:100%;height:100%;display:none"></canvas>
                        <div id="noDataMessage" class="absolute inset-0 flex items-center justify-center text-gray-500 text-lg" style="display:none;">
                            Belum ada riwayat diagnosa
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let chartInstance = null;
        let allData = {};

        function showNoData(show = true) {
            document.getElementById('dataKerusakanPerBulan').style.display = show ? 'none' : '';
            document.getElementById('noDataMessage').style.display = show ? 'flex' : 'none';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('btnFilterBulanTahun');
            const dropdown = document.getElementById('dropdownBulanTahun');
            const dropdownList = document.getElementById('dropdownBulanTahunList');
            let selectedBulanTahun = null;

            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdown.classList.toggle('hidden');
            });
            document.addEventListener('click', function() {
                dropdown.classList.add('hidden');
            });

            fetch('{{ route('dashboard.data-kerusakan') }}')
                .then(response => response.json())
                .then( data => {
                    allData = data.data;
                    const bulanTahunList = data.bulan_tahun;

                    dropdownList.innerHTML = '';
                    bulanTahunList.forEach(val => {
                        const [tahun, bulan] = val.split('-');
                        const namaBulan = [
                            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                        ][parseInt(bulan, 10) - 1];
                        const btnOption = document.createElement('button');
                        btnOption.type = 'button';
                        btnOption.className = 'w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100';
                        btnOption.textContent = `${namaBulan} ${tahun}`;
                        btnOption.dataset.value = val;
                        btnOption.addEventListener('click', function(e) {
                            renderChart(val);
                            dropdown.classList.add('hidden');
                        });
                        dropdownList.appendChild(btnOption);
                    });

                    if (bulanTahunList.length > 0) {
                        renderChart(bulanTahunList[bulanTahunList.length - 1]);
                    } else {
                        showNoData(true);
                    }
                });
        });

        function renderChart(bulanTahun) {
            const ctx = document.getElementById('dataKerusakanPerBulan').getContext('2d');
            const dataBulan = allData[bulanTahun] || { kerusakan: [], jumlah: [] };

            if (!dataBulan.kerusakan.length || !dataBulan.jumlah.length || dataBulan.jumlah.reduce((a, b) => a + b, 0) === 0) {
                if (chartInstance) {
                    chartInstance.destroy();
                    chartInstance = null;
                }
                showNoData(true);
                return;
            }

            showNoData(false);

            if (chartInstance) {
                chartInstance.destroy();
            }

            chartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dataBulan.kerusakan,
                    datasets: [{
                        label: 'Jumlah Kerusakan',
                        data: dataBulan.jumlah,
                        backgroundColor: [
                            'rgba(55, 65, 81, 0.7)',
                            'rgba(107, 114, 128, 0.7)',
                            'rgba(156, 163, 175, 0.7)',
                            'rgba(209, 213, 219, 0.7)',
                            'rgba(229, 231, 235, 0.7)'
                        ],
                        borderColor: [
                            'rgba(55, 65, 81, 1)',
                            'rgba(107, 114, 128, 1)',
                            'rgba(156, 163, 175, 1)',
                            'rgba(209, 213, 219, 1)',
                            'rgba(229, 231, 235, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 10,
                            ticks: { precision: 0 }
                        }
                    }
                }
            });
        }
    </script>
    @endpush
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var sidebar = document.querySelector('.sidebar');
            var charts = document.querySelectorAll('.chart-wrapper canvas');

            function resizeCharts() {
                charts.forEach(function(chart) {
                    chart.style.width = '80%';
                    chart.style.height = '120%';
                });
            }

            var sidebarToggle = document.querySelector('.sidebar-toggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    setTimeout(resizeCharts, 200);
                });
            }

            window.addEventListener('resize', resizeCharts);
            resizeCharts();
        });
    </script>
</x-admin-layout>
