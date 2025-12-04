<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Barang') }}
        </h2>
    </x-slot>

    <style>
        .custom-layout-container {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            gap: 1.5rem; /* 24px */
            align-items: stretch; /* Makes columns same height */
        }
        .custom-layout-main {
            flex-basis: 75%;
            min-width: 0; /* Prevents overflow */
        }
        .custom-layout-sidebar {
            flex-basis: 25%;
            min-width: 0; /* Prevents overflow */
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="custom-layout-container">
                <!-- Left Column: Main Table -->
                <div class="custom-layout-main bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    @livewire('searchable-barang-table')
                </div>

                <!-- Right Column: Filters -->
                <div class="custom-layout-sidebar bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    @livewire('barang-filter')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
