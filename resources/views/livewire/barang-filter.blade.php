<div class="glass-card rounded-xl shadow-xl p-6 border border-gray-200 dark:border-gray-700 h-full flex flex-col hover-lift">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 flex items-center justify-center shadow-lg">
                <i class="fa-solid fa-sliders text-white text-lg"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">Kontrol Barang</h3>
        </div>
        <p class="text-xs text-gray-500 dark:text-gray-400 ml-13">Filter dan kelola inventori Anda</p>
    </div>

    <div class="space-y-4 flex-1">
        
        <!-- Tombol Tambah Barang -->
        <div class="fade-in">
            <a href="{{ route('barang.create') }}" 
               class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 dark:from-blue-500 dark:to-blue-600 text-white rounded-lg font-semibold text-sm shadow-lg hover:shadow-xl hover:from-blue-700 hover:to-blue-800 dark:hover:from-blue-600 dark:hover:to-blue-700 transition-all duration-300 hover:-translate-y-0.5 glow">
                <i class="fa-solid fa-plus-circle text-lg"></i>
                Tambah Barang
            </a>
        </div>

        @if (auth()->user()->isAdmin())
            <!-- Export Section -->
            <div class="fade-in">
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                    <i class="fa-solid fa-download text-green-600 dark:text-green-400"></i>
                    Export Data
                </label>
                <div class="grid grid-cols-2 gap-2">
                    <a href="{{ route('barang.export') }}" 
                       class="flex items-center justify-center gap-2 px-4 py-2.5 bg-white dark:bg-gray-800 border-2 border-green-500 dark:border-green-600 text-green-700 dark:text-green-400 rounded-lg font-semibold text-xs hover:bg-green-50 dark:hover:bg-green-900/30 transition-all shadow-sm hover:shadow-md hover:-translate-y-0.5">
                        <i class="fa-solid fa-file-excel text-base"></i>
                        Excel
                    </a>
                    <a href="{{ route('barang.export.pdf') }}" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       class="flex items-center justify-center gap-2 px-4 py-2.5 bg-white dark:bg-gray-800 border-2 border-red-500 dark:border-red-600 text-red-700 dark:text-red-400 rounded-lg font-semibold text-xs hover:bg-red-50 dark:hover:bg-red-900/30 transition-all shadow-sm hover:shadow-md hover:-translate-y-0.5">
                        <i class="fa-solid fa-file-pdf text-base"></i>
                        PDF
                    </a>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-200 dark:border-gray-700"></div>
        @endif

        <!-- Pencarian Umum -->
        <div class="fade-in">
            <label for="search" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                <i class="fa-solid fa-magnifying-glass text-blue-600 dark:text-blue-400"></i>
                Pencarian
            </label>
            <div class="relative">
                <input wire:model.live.debounce.300ms="search" 
                       id="search" 
                       type="text" 
                       placeholder="Cari nama atau kategori..." 
                       class="w-full pl-10 pr-4 py-2.5 bg-white/80 dark:bg-gray-900/80 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 rounded-lg focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-transparent shadow-sm transition-all">
                <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
            </div>
        </div>

        <!-- Category Filter -->
        <div class="fade-in">
            <label for="categoryFilter" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                <i class="fa-solid fa-layer-group text-purple-600 dark:text-purple-400"></i>
                Kategori
            </label>
            <div class="relative">
                <select wire:model.live="categoryFilter" 
                        id="categoryFilter" 
                        class="w-full appearance-none pl-10 pr-10 py-2.5 bg-white/80 dark:bg-gray-900/80 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-transparent shadow-sm transition-all">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>
                <i class="fa-solid fa-filter absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
                <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
            </div>
        </div>

        <!-- Stock Status Filter -->
        <div class="fade-in">
            <label for="stockStatusFilter" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                <i class="fa-solid fa-boxes-stacked text-orange-600 dark:text-orange-400"></i>
                Status Stok
            </label>
            <div class="relative">
                <select wire:model.live="stockStatusFilter" 
                        id="stockStatusFilter" 
                        class="w-full appearance-none pl-10 pr-10 py-2.5 bg-white/80 dark:bg-gray-900/80 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 rounded-lg focus:ring-2 focus:ring-orange-500 dark:focus:ring-orange-400 focus:border-transparent shadow-sm transition-all">
                    <option value="">Semua Stok</option>
                    <option value="critical">🔴 Stok Kritis (&lt; 5)</option>
                    <option value="low">🟡 Stok Menipis (5-10)</option>
                    <option value="safe">🟢 Stok Aman (&gt; 10)</option>
                </select>
                <i class="fa-solid fa-chart-simple absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
                <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500"></i>
            </div>
        </div>

        <!-- Price Range Filter -->
        <div class="fade-in">
            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                <i class="fa-solid fa-coins text-yellow-600 dark:text-yellow-400"></i>
                Rentang Harga
            </label>
            <div class="space-y-2">
                <div class="relative">
                    <input wire:model.live.debounce.300ms="minPrice" 
                           type="number" 
                           placeholder="Harga Minimum" 
                           class="w-full pl-10 pr-4 py-2.5 bg-white/80 dark:bg-gray-900/80 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 rounded-lg focus:ring-2 focus:ring-yellow-500 dark:focus:ring-yellow-400 focus:border-transparent shadow-sm transition-all">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm font-semibold">Rp</span>
                </div>
                <div class="relative">
                    <input wire:model.live.debounce.300ms="maxPrice" 
                           type="number" 
                           placeholder="Harga Maximum" 
                           class="w-full pl-10 pr-4 py-2.5 bg-white/80 dark:bg-gray-900/80 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 rounded-lg focus:ring-2 focus:ring-yellow-500 dark:focus:ring-yellow-400 focus:border-transparent shadow-sm transition-all">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400 text-sm font-semibold">Rp</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Reset Button -->
    <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
        <a href="{{ route('barang.index') }}" 
           class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-white dark:bg-gray-800 border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg font-semibold text-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition-all shadow-sm hover:shadow-md">
            <i class="fa-solid fa-rotate-right"></i>
            Reset Semua Filter
        </a>
    </div>
</div>