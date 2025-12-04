<div>
    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm h-full flex flex-col">
        <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">Kontrol Karyawan</h3>
            <div class="grid grid-cols-1 gap-4">
                
                <!-- Tombol Aksi -->
                <a href="{{ route('karyawan.create') }}" class="w-full text-center inline-flex items-center justify-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                    Tambah Karyawan
                </a>

                @if (auth()->user()->isAdmin())
                    <!-- Export Section -->
                    <div class="mt-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Export to</label>
                        <div class="flex space-x-2 mt-1">
                            <a href="{{ route('karyawan.export') }}" class="w-full text-center inline-flex items-center justify-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors ease-in-out duration-150">
                                Excel
                            </a>
                            <a href="{{ route('karyawan.export.pdf') }}" target="_blank" rel="noopener noreferrer" class="w-full text-center inline-flex items-center justify-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors ease-in-out duration-150">
                                PDF
                            </a>
                        </div>
                    </div>
                @endif

                <!-- Pencarian Umum -->
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pencarian</label>
                    <input wire:model.live.debounce.300ms="search" id="search" type="text" placeholder="Ketik untuk mencari..." class="mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                </div>

                <!-- Filter Jabatan -->
                <div>
                    <label for="jabatan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jabatan</label>
                    <select wire:model.live="jabatan" id="jabatan" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        <option value="">Semua Jabatan</option>
                        @foreach ($jabatans as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Umur -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rentang Umur</label>
                    <div class="flex space-x-2 mt-1">
                        <input wire:model.live.debounce.300ms="minUmur" type="number" placeholder="Min" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        <input wire:model.live.debounce.300ms="maxUmur" type="number" placeholder="Max" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    </div>
                </div>

                <!-- Filter Tanggal Masuk -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rentang Tgl Masuk</label>
                    <div class="mt-1">
                        <label for="tglMasukDari" class="text-xs text-gray-500 dark:text-gray-400">Dari</label>
                        <input wire:model.live="tglMasukDari" id="tglMasukDari" type="date" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    </div>
                    <div class="mt-1">
                        <label for="tglMasukSampai" class="text-xs text-gray-500 dark:text-gray-400">Sampai</label>
                        <input wire:model.live="tglMasukSampai" id="tglMasukSampai" type="date" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    </div>
                </div>

            </div>
        </div>
        <div class="mt-auto p-4 flex justify-end">
            <a href="{{ route('karyawan.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                Reset Semua Filter
            </a>
        </div>
    </div>
</div>
