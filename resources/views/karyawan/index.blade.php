<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 dark:text-gray-100 leading-tight">
            {{ __('Manajemen Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <style>
                .custom-layout {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 1.5rem;
                    align-items: stretch;
                }
                .custom-layout-main {
                    flex: 3 1 0%;
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
                <!-- Main Content -->
                <div class="custom-layout-main glass-card overflow-hidden shadow-sm sm:rounded-lg fade-in hover-lift border border-gray-200 dark:border-gray-700">
                    <div class="bg-gradient-to-r from-purple-500/10 to-pink-500/10 dark:from-purple-900/20 dark:to-pink-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 flex items-center">
                                <i class="fas fa-users mr-3 text-purple-600 dark:text-purple-400"></i>
                                Daftar Karyawan
                            </h3>
                            <div class="flex items-center space-x-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 dark:bg-purple-900/50 text-purple-800 dark:text-purple-300">
                                    <i class="fas fa-user-friends mr-1"></i>
                                    Total Karyawan
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        @livewire('searchable-karyawan-table')
                    </div>
                </div>
                
                <!-- Sidebar Filter -->
                <div class="custom-layout-sidebar glass-card overflow-hidden shadow-sm sm:rounded-lg fade-in hover-lift border border-gray-200 dark:border-gray-700">
                    <div class="bg-gradient-to-r from-blue-500/10 to-cyan-500/10 dark:from-blue-900/20 dark:to-cyan-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 flex items-center">
                            <i class="fas fa-filter mr-3 text-blue-600 dark:text-blue-400"></i>
                            Filter & Pencarian
                        </h3>
                    </div>
                    <div class="p-6">
                        @livewire('karyawan-filter')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>