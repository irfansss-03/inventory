<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 dark:text-gray-100 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-card overflow-hidden shadow-sm sm:rounded-lg fade-in">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (auth()->user()->isAdmin())
                        <h3 class="text-lg font-semibold mb-6 text-gray-900 dark:text-gray-100">Ringkasan Data Inventori</h3>

                        <div class="grid gap-6 mb-8 md:grid-cols-2 lg:grid-cols-3">

                            {{-- Total Barang Card --}}
                            <div class="glass-card glow p-6 rounded-lg shadow-lg flex items-center justify-between hover-lift bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 border border-blue-200 dark:border-blue-700/50">
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-gray-100 text-lg">Total Barang</h4>
                                    <p class="text-4xl font-bold text-blue-600 dark:text-blue-300">{{ $totalBarang }}</p>
                                </div>
                                <div class="text-blue-600 dark:text-blue-400 text-5xl opacity-20">
                                    <i class="fa-solid fa-boxes-stacked"></i>
                                </div>
                            </div>

                            {{-- Total Karyawan Card --}}
                            <div class="glass-card glow-green p-6 rounded-lg shadow-lg flex items-center justify-between hover-lift bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/30 dark:to-green-800/30 border border-green-200 dark:border-green-700/50">
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-gray-100 text-lg">Total Karyawan</h4>
                                    <p class="text-4xl font-bold text-green-600 dark:text-green-300">{{ $totalKaryawan }}</p>
                                </div>
                                <div class="text-green-600 dark:text-green-400 text-5xl opacity-20">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                            </div>

                            {{-- Status Stok Card --}}
                            <div class="glass-card glow-purple p-6 rounded-lg shadow-lg hover-lift bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/30 dark:to-purple-800/30 border border-purple-200 dark:border-purple-700/50">
                                <div>
                                    <h4 class="font-bold text-gray-900 dark:text-gray-100 text-lg mb-3">Status Stok</h4>
                                    <div class="space-y-2">
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm text-gray-700 dark:text-gray-300">Kritis:</p>
                                            <span class="font-bold text-red-600 dark:text-red-400">{{ $stokKritis }}</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm text-gray-700 dark:text-gray-300">Menipis:</p>
                                            <span class="font-bold text-yellow-600 dark:text-yellow-400">{{ $stokMenipis }}</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm text-gray-700 dark:text-gray-300">Aman:</p>
                                            <span class="font-bold text-green-600 dark:text-green-400">{{ $stokAman }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        {{-- Charts Section --}}
                        <div class="grid gap-6 mt-8 lg:grid-cols-2">
                            {{-- Barang per Kategori Pie Chart --}}
                            <div class="glass-card p-6 rounded-lg shadow-lg flex flex-col gap-4 hover-lift border border-gray-200 dark:border-gray-700">
                                <div class="w-full flex flex-col gap-3">
                                    <div class="flex flex-col gap-2">
                                        <div class="flex items-center justify-between gap-4">
                                            <h4 class="font-bold text-lg text-gray-900 dark:text-gray-100">Barang per Kategori</h4>
                                            <form method="GET" action="{{ route('dashboard') }}" class="flex items-center gap-2 text-sm">
                                                <label for="barang_range" class="text-gray-700 dark:text-gray-300">Rentang</label>
                                                <div>
                                                    <select id="barang_range" name="barang_range" onchange="this.form.submit()" class="text-sm rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500">
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
                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                            Menampilkan data: {{ $rangeLabels[$selectedBarangRange] ?? 'Semua' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="relative w-64 h-64 mx-auto">
                                    <canvas id="barangByCategoryChart"></canvas>
                                </div>
                                @if (count($barangLegend))
                                    <div class="w-full space-y-2">
                                        @foreach ($barangLegend as $legend)
                                            <div class="flex items-center justify-between text-sm text-gray-800 dark:text-gray-200 p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700/50 transition-colors">
                                                <div class="flex items-center">
                                                    <span class="w-4 h-4 rounded-full shadow-sm" style="background-color: {{ $legend['color'] }}"></span>
                                                    <span class="ml-2">{{ $legend['label'] }}</span>
                                                </div>
                                                <span class="font-semibold">{{ $legend['value'] }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-sm text-gray-600 dark:text-gray-400 text-center w-full">Tidak ada data pada rentang ini.</p>
                                @endif
                            </div>

                            {{-- Karyawan per Jabatan Bar Chart --}}
                            <div class="glass-card p-6 rounded-lg shadow-lg flex flex-col gap-4 hover-lift border border-gray-200 dark:border-gray-700">
                                <h4 class="font-bold text-lg mb-4 text-gray-900 dark:text-gray-100">Karyawan per Jabatan</h4>
                                <div class="relative h-80">
                                    <canvas id="karyawanByJabatanChart"></canvas>
                                </div>
                                @if (count($karyawanLegend))
                                    <div class="w-full space-y-2">
                                        @foreach ($karyawanLegend as $legend)
                                            <div class="flex items-center justify-between text-sm text-gray-800 dark:text-gray-200 p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700/50 transition-colors">
                                                <div class="flex items-center">
                                                    <span class="w-4 h-4 rounded-full shadow-sm" style="background-color: {{ $legend['color'] }}"></span>
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
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Halo, {{ auth()->user()->name }}! 👋</h3>
                            <p class="text-sm text-gray-700 dark:text-gray-300">Anda masuk sebagai <span class="font-semibold text-blue-600 dark:text-blue-400">Staff</span>. Gunakan menu Barang untuk memperbarui stok.</p>
                            <div>
                                <a href="{{ route('barang.index') }}" class="block p-6 glass-card rounded-lg shadow-lg hover-lift glow bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/30 dark:to-blue-800/30 border border-blue-200 dark:border-blue-700/50 transition-all duration-300">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-xl font-semibold text-blue-900 dark:text-blue-200">Manajemen Barang</p>
                                            <p class="text-sm text-gray-700 dark:text-gray-300 mt-1">Lihat stok & perbarui data</p>
                                        </div>
                                        <i class="fa-solid fa-box text-4xl text-blue-600 dark:text-blue-400"></i>
                                    </div>
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
            const isDarkMode = document.documentElement.classList.contains('dark');
            const textColor = isDarkMode ? 'rgb(229, 231, 235)' : 'rgb(55, 65, 81)';
            const gridColor = isDarkMode ? 'rgba(75, 85, 99, 0.3)' : 'rgba(209, 213, 219, 0.3)';

            // Data for Barang by Category Pie Chart
            const barangByCategoryData = {
                labels: @json($barangChartLabels),
                datasets: [{
                    data: @json($barangChartData),
                    backgroundColor: @json($barangChartColors),
                    hoverBackgroundColor: @json($barangChartColors),
                    borderWidth: 2,
                    borderColor: isDarkMode ? 'rgba(15, 23, 42, 0.5)' : 'rgba(255, 255, 255, 0.8)'
                }]
            };

            const barangByCategoryConfig = {
                type: 'pie',
                data: barangByCategoryData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                        title: {
                            display: false,
                        },
                        tooltip: {
                            backgroundColor: isDarkMode ? 'rgba(31, 41, 55, 0.9)' : 'rgba(255, 255, 255, 0.9)',
                            titleColor: textColor,
                            bodyColor: textColor,
                            borderColor: isDarkMode ? 'rgba(75, 85, 99, 0.5)' : 'rgba(209, 213, 219, 0.5)',
                            borderWidth: 1,
                            padding: 12,
                            displayColors: true,
                            boxWidth: 15,
                            boxHeight: 15,
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
                    borderWidth: 2,
                    borderRadius: 8,
                }]
            };

            const karyawanByJabatanConfig = {
                type: 'bar',
                data: karyawanByJabatanData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        },
                        title: {
                            display: false,
                        },
                        tooltip: {
                            backgroundColor: isDarkMode ? 'rgba(31, 41, 55, 0.9)' : 'rgba(255, 255, 255, 0.9)',
                            titleColor: textColor,
                            bodyColor: textColor,
                            borderColor: isDarkMode ? 'rgba(75, 85, 99, 0.5)' : 'rgba(209, 213, 219, 0.5)',
                            borderWidth: 1,
                            padding: 12,
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: textColor,
                                font: {
                                    size: 12
                                }
                            },
                            grid: {
                                color: gridColor,
                                drawBorder: false,
                            }
                        },
                        x: {
                            ticks: {
                                display: false,
                            },
                            grid: {
                                display: false,
                                drawBorder: false,
                            }
                        }
                    }
                },
            };

            karyawanByJabatanConfig.data.datasets[0].barPercentage = 0.9;
            karyawanByJabatanConfig.data.datasets[0].categoryPercentage = 0.8;

            new Chart(
                document.getElementById('karyawanByJabatanChart'),
                karyawanByJabatanConfig
            );
        });
    </script>
</x-app-layout>