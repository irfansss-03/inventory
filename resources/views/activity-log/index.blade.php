<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 dark:text-gray-100 leading-tight">
            {{ __('Log Aktivitas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <style>
                .custom-layout {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 1.5rem;
                    align-items: flex-start;
                }
                .custom-layout-main {
                    flex: 2 1 0%;
                    min-width: 0;
                }
                .custom-layout-sidebar {
                    flex: 1 1 0%;
                    min-width: 300px;
                }
                
                @media (max-width: 1024px) {
                    .custom-layout {
                        flex-direction: column;
                    }
                    .custom-layout-main,
                    .custom-layout-sidebar {
                        flex: 1 1 100%;
                    }
                }
            </style>
            
            <div class="custom-layout">
                {{-- Main Content (Table) --}}
                <div class="custom-layout-main">
                    <div class="glass-card overflow-hidden shadow-sm sm:rounded-lg fade-in hover-lift border border-gray-200 dark:border-gray-700">
                        <div class="bg-gradient-to-r from-orange-500/10 to-red-500/10 dark:from-orange-900/20 dark:to-red-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 flex items-center">
                                    <i class="fas fa-history mr-3 text-orange-600 dark:text-orange-400"></i>
                                    Riwayat Aktivitas
                                </h3>
                                <div class="flex items-center space-x-2">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-100 dark:bg-orange-900/50 text-orange-800 dark:text-orange-300">
                                        <i class="fas fa-database mr-1"></i>
                                        {{ $activities->total() }} Log
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                                <i class="fas fa-file-alt mr-2"></i>Deskripsi
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                                <i class="fas fa-user mr-2"></i>User
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                                <i class="fas fa-exchange-alt mr-2"></i>Perubahan
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">
                                                <i class="fas fa-clock mr-2"></i>Waktu
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="glass-card divide-y divide-gray-200 dark:divide-gray-700">
                                        @forelse ($activities as $activity)
                                            @php
                                                $changes = $activity->changes ?? [];
                                                $old = $changes['old'] ?? [];
                                                $new = $changes['attributes'] ?? [];
                                            @endphp
                                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-200">
                                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                                    <div class="flex items-center">
                                                        <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300">
                                                            {{ $activity->description }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-8 w-8 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white font-bold text-xs">
                                                            {{ substr($activity->causer ? $activity->causer->name : 'System', 0, 1) }}
                                                        </div>
                                                        <div class="ml-3">
                                                            <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                                {{ $activity->causer ? $activity->causer->name : 'System' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                                    @if ($old || $new)
                                                        <div class="space-y-2">
                                                            @foreach ($new as $field => $value)
                                                                <div class="glass-card p-2 rounded-md bg-gradient-to-r from-blue-50 to-purple-50 dark:from-blue-900/20 dark:to-purple-900/20 border border-blue-200 dark:border-blue-700/50">
                                                                    <span class="font-semibold text-gray-700 dark:text-gray-200">{{ $field }}</span>:
                                                                    <div class="flex items-center mt-1 text-xs">
                                                                        <span class="px-2 py-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded">{{ $old[$field] ?? '-' }}</span>
                                                                        <i class="fas fa-arrow-right mx-2 text-gray-400"></i>
                                                                        <span class="px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded">{{ $value }}</span>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <span class="text-xs text-gray-400 italic">Tidak ada perubahan</span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                    <div class="flex items-center text-gray-500 dark:text-gray-400">
                                                        <i class="far fa-calendar-alt mr-2 text-orange-500"></i>
                                                        {{ $activity->created_at->diffForHumans() }}
                                                    </div>
                                                    <div class="text-xs text-gray-400 mt-1">
                                                        {{ $activity->created_at->format('d M Y, H:i') }}
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="px-6 py-12 text-center">
                                                    <div class="flex flex-col items-center justify-center">
                                                        <i class="fas fa-inbox text-6xl text-gray-300 dark:text-gray-600 mb-4"></i>
                                                        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Tidak ada aktivitas yang cocok dengan filter Anda.</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-6">
                                {{ $activities->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Sidebar (Filters) --}}
                <div class="custom-layout-sidebar">
                    <div class="glass-card rounded-lg shadow-sm fade-in hover-lift border border-gray-200 dark:border-gray-700">
                        <div class="bg-gradient-to-r from-purple-500/10 to-pink-500/10 dark:from-purple-900/20 dark:to-pink-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 flex items-center">
                                <i class="fas fa-sliders-h mr-3 text-purple-600 dark:text-purple-400"></i>
                                Filter Log
                            </h3>
                        </div>
                        
                        <div class="p-6">
                            <form action="{{ route('activity-log.index') }}" method="GET">
                                <div class="grid grid-cols-1 gap-4">
                                    <!-- Filter by User -->
                                    <div class="transform transition-all duration-300 hover:scale-[1.02]">
                                        <label for="user_id" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2 flex items-center">
                                            <i class="fas fa-user-circle mr-2 text-blue-600 dark:text-blue-400"></i>
                                            User
                                        </label>
                                        <select name="user_id" id="user_id" class="block w-full glass-card border-gray-300 dark:border-gray-600 dark:bg-gray-900/50 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm transition-all duration-300">
                                            <option value="">Semua User</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}" {{ ($filters['user_id'] ?? '') == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Filter by Date Range -->
                                    <div class="transform transition-all duration-300 hover:scale-[1.02]">
                                        <label for="date_range" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2 flex items-center">
                                            <i class="fas fa-calendar-alt mr-2 text-green-600 dark:text-green-400"></i>
                                            Rentang Waktu
                                        </label>
                                        <select name="date_range" id="date_range" class="block w-full glass-card border-gray-300 dark:border-gray-600 dark:bg-gray-900/50 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm transition-all duration-300">
                                            <option value="">Semua Waktu</option>
                                            <option value="today" {{ ($filters['date_range'] ?? '') == 'today' ? 'selected' : '' }}>Hari Ini</option>
                                            <option value="yesterday" {{ ($filters['date_range'] ?? '') == 'yesterday' ? 'selected' : '' }}>Kemarin</option>
                                            <option value="last_week" {{ ($filters['date_range'] ?? '') == 'last_week' ? 'selected' : '' }}>Minggu Lalu</option>
                                            <option value="last_month" {{ ($filters['date_range'] ?? '') == 'last_month' ? 'selected' : '' }}>Bulan Lalu</option>
                                        </select>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex items-center space-x-2 mt-2">
                                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-300 hover-lift glow shadow-lg">
                                            <i class="fas fa-search mr-2"></i>
                                            Filter
                                        </button>
                                        <a href="{{ route('activity-log.index') }}" class="w-full inline-flex items-center justify-center px-4 py-2 glass-card border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-50 dark:hover:bg-gray-700/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-300 hover-lift">
                                            <i class="fas fa-redo mr-2"></i>
                                            Reset
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Delete Logs Panel --}}
                    <div class="glass-card rounded-lg shadow-sm mt-6 fade-in hover-lift border border-red-300 dark:border-red-700/50">
                        <div class="bg-gradient-to-r from-red-500/10 to-orange-500/10 dark:from-red-900/20 dark:to-orange-900/20 px-6 py-4 border-b border-red-200 dark:border-red-700/50">
                            <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100 flex items-center">
                                <i class="fas fa-trash-alt mr-3 text-red-600 dark:text-red-400"></i>
                                Hapus Log
                            </h4>
                        </div>
                        
                        <div class="p-6">
                            <div class="glass-card glow-red rounded-lg p-4 mb-4 bg-gradient-to-br from-red-50 to-orange-50 dark:from-red-900/30 dark:to-orange-900/30 border border-red-200 dark:border-red-700/50">
                                <div class="flex items-start">
                                    <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400 text-xl mt-0.5 mr-3"></i>
                                    <p class="text-xs text-red-700 dark:text-red-400 leading-relaxed">
                                        <strong>Peringatan:</strong> Aksi ini bersifat permanen dan tidak dapat dibatalkan. Pastikan Anda benar-benar yakin sebelum menghapus log.
                                    </p>
                                </div>
                            </div>
                            
                            <form action="{{ route('activity-log.clear') }}" method="POST" onsubmit="return confirm('⚠️ PERINGATAN: Aksi ini tidak dapat dibatalkan. Anda yakin ingin menghapus log ini secara permanen?');">
                                @csrf
                                <div class="grid grid-cols-1 gap-4">
                                    <div class="transform transition-all duration-300 hover:scale-[1.02]">
                                        <label for="delete_date_range" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-2 flex items-center">
                                            <i class="fas fa-calendar-times mr-2 text-red-600 dark:text-red-400"></i>
                                            Hapus Log Untuk
                                        </label>
                                        <select name="date_range" id="delete_date_range" class="block w-full glass-card border-red-300 dark:border-red-700 dark:bg-gray-900/50 dark:text-gray-300 focus:border-red-500 dark:focus:border-red-600 focus:ring-red-500 dark:focus:ring-red-600 rounded-md shadow-sm transition-all duration-300" required>
                                            <option value="">Pilih Rentang Waktu...</option>
                                            <option value="today">Hari Ini</option>
                                            <option value="yesterday">Kemarin</option>
                                            <option value="last_week">Minggu Lalu</option>
                                            <option value="last_month">Bulan Lalu</option>
                                            <option value="all">⚠️ Semua Log (Berbahaya!)</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-300 hover-lift glow-red shadow-lg">
                                        <i class="fas fa-trash mr-2"></i>
                                        Hapus Sekarang
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>