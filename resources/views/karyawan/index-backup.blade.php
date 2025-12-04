<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <style>
                .custom-layout {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 1.5rem; /* 24px */
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
            </style>
            <div class="custom-layout">
                <div class="custom-layout-main">
                    @livewire('searchable-karyawan-table')
                </div>
                <div class="custom-layout-sidebar">
                    @livewire('karyawan-filter')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
