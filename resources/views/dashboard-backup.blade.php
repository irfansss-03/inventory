<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (auth()->user()->isAdmin())
                        <h3 class="text-lg font-semibold mb-6">Ringkasan Data Inventori</h3>

                        <div class="grid gap-6 mb-8 md:grid-cols-2 lg:grid-cols-3">

                            {{-- Total Barang Card --}}
                            <div class="bg-blue-100 dark:bg-yellow-900 p-6 rounded-lg shadow flex items-center justify-between">
                                <div>
                                    <h4 class="font-bold text-black dark:text-gray-100 text-lg">Total Barang</h4>
                                    <p class="text-4xl font-bold text-black dark:text-gray-100">{{ $totalBarang }}</p>
                                </div>
                                <div class="text-blue-600 dark:text-blue-300 text-4xl">
                                    <i class="fa-solid fa-boxes-stacked"></i>
                                </div>
                            </div>

                            {{-- Total Karyawan Card --}}
                            <div class="bg-green-100 dark:bg-blue-900 p-6 rounded-lg shadow flex items-center justify-between">
                                <div>
                                    <h4 class="font-bold text-black dark:text-gray-100 text-lg">Total Karyawan</h4>
                                    <p class="text-4xl font-bold text-black dark:text-gray-100">{{ $totalKaryawan }}</p>
                                </div>
                                <div class="text-green-600 dark:text-green-300 text-4xl">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                            </div>

                            {{-- Status Stok Card --}}
                            <div class="bg-yellow-100 dark:bg-green-900 p-6 rounded-lg shadow">
                                <div>
                                    <h4 class="font-bold text-black dark:text-gray-100 text-lg mb-2">Status Stok</h4>
                                    <p class="text-md text-black dark:text-gray-100">Kritis: <span class="font-bold">{{ $stokKritis }}</span></p>
                                    <p class="text-md text-black dark:text-gray-100">Menipis: <span class="font-bold">{{ $stokMenipis }}</span></p>
                                    <p class="text-md text-black dark:text-gray-100">Aman: <span class="font-bold">{{ $stokAman }}</span></p>
                                </div>
                            </div>

                        </div>

                        {{-- Charts Section --}}
                        <div class="grid gap-6 mt-8 lg:grid-cols-2">
                            {{-- Barang per Kategori Pie Chart --}}
                            <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow flex flex-col gap-4">
                                <div class="w-full flex flex-col gap-3">
                                    <div class="flex flex-col gap-2">
                                        <div class="flex items-center justify-between gap-4">
                                            <h4 class="font-bold text-lg text-gray-900 dark:text-gray-100">Barang per Kategori</h4>
                                            <form method="GET" action="{{ route('dashboard') }}" class="flex items-center gap-2 text-sm">
                                                <label for="barang_range" class="text-gray-600 dark:text-gray-300">Rentang</label>
                                                <div>
                                                    <select id="barang_range" name="barang_range" onchange="this.form.submit()" class="text-sm rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500">
                                                        @php
                                                            $rangeLabels = [
                                                                'all' => 'Semua',
                                                                'today' => 'Hari Ini',
                                                                'last_week' => 'Minggu Lalu',
                                                                'last_month' => 'Bulan Lalu',
                                                            ];
                                                        @endphp
                                                        @foreach ($rangeLabels as $key => $label)
                                                            <option value="{{ $key }}" @selected($selectedBarangRange === $key)>{{ $label }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @foreach(request()->except('barang_range') as $name => $value)
                                                    <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                                                @endforeach
                                            </form>
                                        </div>
                                        <p class="text-xs text-gray-500 dark:text-gray-300">
                                            Menampilkan data: {{ $rangeLabels[$selectedBarangRange] ?? 'Semua' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="relative w-64 h-64 mx-auto"> {{-- Controlled size container --}}
                                    <canvas id="barangByCategoryChart"></canvas>
                                </div>
                                @if (count($barangLegend))
                                    <div class="w-full space-y-2">
                                        @foreach ($barangLegend as $legend)
                                            <div class="flex items-center justify-between text-sm text-gray-700 dark:text-gray-200">
                                                <div class="flex items-center">
                                                    <span class="w-3 h-3 rounded-full" style="background-color: {{ $legend['color'] }}"></span>
                                                    <span class="ml-2">{{ $legend['label'] }}</span>
                                                </div>
                                                <span class="font-semibold">{{ $legend['value'] }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-sm text-gray-500 dark:text-gray-300 text-center w-full">Tidak ada data pada rentang ini.</p>
                                @endif
                            </div>

                            {{-- Karyawan per Jabatan Bar Chart --}}
                            <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow flex flex-col gap-4">
                                <h4 class="font-bold text-lg mb-4 text-gray-900 dark:text-gray-100">Karyawan per Jabatan</h4>
                                <div class="relative h-80"> {{-- Controlled size container --}}
                                    <canvas id="karyawanByJabatanChart"></canvas>
                                </div>
                                @if (count($karyawanLegend))
                                    <div class="w-full space-y-2">
                                        @foreach ($karyawanLegend as $legend)
                                            <div class="flex items-center justify-between text-sm text-gray-700 dark:text-gray-200">
                                                <div class="flex items-center">
                                                    <span class="w-3 h-3 rounded-full" style="background-color: {{ $legend['color'] }}"></span>
                                                    <span class="ml-2">{{ $legend['label'] }}</span>
                                                </div>
                                                <span class="font-semibold">{{ $legend['value'] }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="space-y-6">
                            <h3 class="text-lg font-semibold">Halo, {{ auth()->user()->name }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Anda masuk sebagai <span class="font-semibold">staff</span>. Gunakan menu Barang untuk memperbarui stok.</p>
                            <div>
                                <a href="{{ route('barang.index') }}" class="p-6 bg-blue-100 dark:bg-gray-700 rounded-lg shadow flex items-center justify-between">
                                    <div>
                                        <p class="text-xl font-semibold text-blue-900 dark:text-blue-200">Manajemen Barang</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-300">Lihat stok & perbarui data</p>
                                    </div>
                                    <i class="fa-solid fa-box text-3xl text-blue-700 dark:text-blue-300"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data for Barang by Category Pie Chart
            const barangByCategoryData = {
                labels: @json($barangChartLabels),
                datasets: [{
                    data: @json($barangChartData),
                    backgroundColor: @json($barangChartColors),
                    hoverBackgroundColor: @json($barangChartColors)
                }]
            };

            const barangByCategoryConfig = {
                type: 'pie',
                data: barangByCategoryData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Disable aspect ratio maintenance
                    plugins: {
                        legend: {
                            display: false,
                        },
                        title: {
                            display: false,
                        }
                    }
                },
            };

            new Chart(
                document.getElementById('barangByCategoryChart'),
                barangByCategoryConfig
            );

            // Data for Karyawan by Jabatan Bar Chart
            const karyawanByJabatanData = {
                labels: @json($karyawanByJabatan->keys()),
                datasets: [{
                    label: 'Jumlah Karyawan',
                    data: @json($karyawanByJabatan->values()),
                    backgroundColor: @json($karyawanChartColors),
                    borderColor: @json($karyawanChartColors),
                    borderWidth: 1
                }]
            };

            const karyawanByJabatanConfig = {
                type: 'bar',
                data: karyawanByJabatanData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Disable aspect ratio maintenance
                    plugins: {
                        legend: {
                            display: false,
                        },
                        title: {
                            display: false,
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: 'rgb(156, 163, 175)' // Tailwind gray-400
                            }
                        },
                        x: {
                            ticks: {
                                display: false,
                            },
                            grid: {
                                display: false,
                            }
                        }
                    }
                },
            };

            // Adjust bar width for better space utilization
            karyawanByJabatanConfig.data.datasets[0].barPercentage = 0.9;
            karyawanByJabatanConfig.data.datasets[0].categoryPercentage = 0.8;

            new Chart(
                document.getElementById('karyawanByJabatanChart'),
                karyawanByJabatanConfig
            );
        });
    </script>
</x-app-layout>
