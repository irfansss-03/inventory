<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Log Aktivitas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <style>
                .custom-layout {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 1.5rem; /* 24px */
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
            </style>
            <div class="custom-layout">
                {{-- Main Content (Table) --}}
                <div class="custom-layout-main">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Deskripsi</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">User</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Perubahan</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @forelse ($activities as $activity)
                                            @php
                                                $changes = $activity->changes ?? [];
                                                $old = $changes['old'] ?? [];
                                                $new = $changes['attributes'] ?? [];
                                            @endphp
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $activity->description }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $activity->causer ? $activity->causer->name : 'System' }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                                    @if ($old || $new)
                                                        <div class="space-y-1">
                                                            @foreach ($new as $field => $value)
                                                                <div>
                                                                    <span class="font-semibold text-gray-700 dark:text-gray-200">{{ $field }}</span>:
                                                                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ $old[$field] ?? '-' }}</span>
                                                                    <span class="mx-1 text-gray-400">→</span>
                                                                    <span class="text-xs text-gray-500 dark:text-gray-200">{{ $value }}</span>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <span class="text-xs text-gray-400">-</span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $activity->created_at->diffForHumans() }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500 dark:text-gray-400">
                                                    Tidak ada aktivitas yang cocok dengan filter Anda.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                {{ $activities->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Sidebar (Filters) --}}
                <div class="custom-layout-sidebar">
                    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">Filter Log</h3>
                        <form action="{{ route('activity-log.index') }}" method="GET">
                            <div class="grid grid-cols-1 gap-4">
                                <!-- Filter by User -->
                                <div>
                                    <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">User</label>
                                    <select name="user_id" id="user_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                        <option value="">Semua User</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ ($filters['user_id'] ?? '') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Filter by Date Range -->
                                <div>
                                    <label for="date_range" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rentang Waktu</label>
                                                                    <select name="date_range" id="date_range" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                                                        <option value="">Semua Waktu</option>
                                                                        <option value="today" {{ ($filters['date_range'] ?? '') == 'today' ? 'selected' : '' }}>Hari Ini</option>
                                                                        <option value="yesterday" {{ ($filters['date_range'] ?? '') == 'yesterday' ? 'selected' : '' }}>Kemarin</option>
                                                                        <option value="last_week" {{ ($filters['date_range'] ?? '') == 'last_week' ? 'selected' : '' }}>Minggu Lalu</option>
                                                                        <option value="last_month" {{ ($filters['date_range'] ?? '') == 'last_month' ? 'selected' : '' }}>Bulan Lalu</option>
                                                                    </select>                                </div>

                                <!-- Action Buttons -->
                                <div class="flex items-center space-x-2 mt-2">
                                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                        Filter
                                    </button>
                                    <a href="{{ route('activity-log.index') }}" class="w-full inline-flex items-center justify-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                                        Reset
                                    </a>
                                </div>
                            </div>
                        </form>

                        {{-- Delete Logs Panel --}}
                        <div class="mt-6 border-t border-gray-200 dark:border-gray-600 pt-4">
                             <h4 class="text-md font-semibold text-gray-900 dark:text-gray-100 mb-3">Hapus Log</h4>
                             <div class="border border-red-400 dark:border-red-600 rounded-lg p-4">
                                <form action="{{ route('activity-log.clear') }}" method="POST" onsubmit="return confirm('PERINGATAN: Aksi ini tidak dapat dibatalkan. Anda yakin ingin menghapus log ini secara permanen?');">
                                    @csrf
                                    <div class="grid grid-cols-1 gap-4">
                                        <div>
                                            <label for="delete_date_range" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Hapus Log Untuk</label>
                                            <select name="date_range" id="delete_date_range" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                                <option value="">Pilih Rentang Waktu...</option>
                                                <option value="today">Hari Ini</option>
                                                <option value="yesterday">Kemarin</option>
                                                <option value="last_week">Minggu Lalu</option>
                                                <option value="last_month">Bulan Lalu</option>
                                                <option value="all">Semua Log</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                            Hapus
                                        </button>
                                    </div>
                                </form>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
