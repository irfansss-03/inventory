<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 dark:text-gray-100 leading-tight">
            {{ __('Manajemen Barang') }}
        </h2>
    </x-slot>

    <style>
        .custom-layout-container {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            gap: 1.5rem;
            align-items: stretch;
        }
        .custom-layout-main {
            flex-basis: 75%;
            min-width: 0;
        }
        .custom-layout-sidebar {
            flex-basis: 25%;
            min-width: 0;
        }
        
        /* Responsive Design */
        @media (max-width: 1024px) {
            .custom-layout-container {
                flex-direction: column;
            }
            .custom-layout-main,
            .custom-layout-sidebar {
                flex-basis: 100%;
            }
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="custom-layout-container">
                <!-- Left Column: Main Table -->
                <div class="custom-layout-main glass-card overflow-hidden shadow-sm sm:rounded-lg fade-in hover-lift border border-gray-200 dark:border-gray-700">
                    <div class="bg-gradient-to-r from-blue-500/10 to-purple-500/10 dark:from-blue-900/20 dark:to-purple-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 flex items-center">
                                <i class="fas fa-table mr-3 text-blue-600 dark:text-blue-400"></i>
                                Daftar Barang
                            </h3>
                            <div class="flex items-center space-x-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/50 text-blue-800 dark:text-blue-300">
                                    <i class="fas fa-boxes mr-1"></i>
                                    Total Item
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        @livewire('searchable-barang-table')
                    </div>
                </div>

                <!-- Right Column: Filters -->
                <div class="custom-layout-sidebar glass-card overflow-hidden shadow-sm sm:rounded-lg fade-in hover-lift border border-gray-200 dark:border-gray-700">
                    <div class="bg-gradient-to-r from-purple-500/10 to-pink-500/10 dark:from-purple-900/20 dark:to-pink-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 flex items-center">
                            <i class="fas fa-filter mr-3 text-purple-600 dark:text-purple-400"></i>
                            Filter & Pencarian
                        </h3>
                    </div>
                    <div class="p-6">
                        @livewire('barang-filter')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>