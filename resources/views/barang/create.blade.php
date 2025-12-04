<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 dark:text-gray-100 leading-tight">
            {{ __('Tambah Barang Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-card overflow-hidden shadow-sm sm:rounded-lg fade-in">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if ($errors->any())
                        <div class="mb-4 glass-card glow-red p-4 rounded-lg bg-gradient-to-br from-red-50 to-red-100 dark:from-red-900/30 dark:to-red-800/30 border border-red-200 dark:border-red-700/50">
                            <div class="font-medium text-red-600 dark:text-red-400 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Whoops! Ada yang salah.
                            </div>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('barang.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Nama -->
                        <div class="transform transition-all duration-300 hover:scale-[1.01]">
                            <x-input-label for="nama" :value="__('Nama Barang')" class="text-gray-900 dark:text-gray-100 font-semibold" />
                            <x-text-input id="nama" class="block mt-1 w-full glass-card border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" type="text" name="nama" :value="old('nama')" required autofocus />
                        </div>

                        <!-- Kategori -->
                        <div class="transform transition-all duration-300 hover:scale-[1.01]">
                            <x-input-label for="kategori" :value="__('Kategori')" class="text-gray-900 dark:text-gray-100 font-semibold" />
                            <x-text-input id="kategori" class="block mt-1 w-full glass-card border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" type="text" name="kategori" :value="old('kategori')" required />
                        </div>

                        <!-- Stok -->
                        <div class="transform transition-all duration-300 hover:scale-[1.01]">
                            <x-input-label for="stok" :value="__('Stok')" class="text-gray-900 dark:text-gray-100 font-semibold" />
                            <x-text-input id="stok" class="block mt-1 w-full glass-card border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" type="number" name="stok" :value="old('stok')" required />
                        </div>

                        <!-- Harga -->
                        <div class="transform transition-all duration-300 hover:scale-[1.01]">
                            <x-input-label for="harga" :value="__('Harga')" class="text-gray-900 dark:text-gray-100 font-semibold" />
                            <x-text-input id="harga" class="block mt-1 w-full glass-card border-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring-blue-500 transition-all duration-300" type="number" name="harga" :value="old('harga')" required step="1" />
                        </div>

                        <!-- Deskripsi -->
                        <div class="transform transition-all duration-300 hover:scale-[1.01]">
                            <x-input-label for="deskripsi" :value="__('Deskripsi')" class="text-gray-900 dark:text-gray-100 font-semibold" />
                            <textarea id="deskripsi" name="deskripsi" rows="4" class="block mt-1 w-full glass-card border-gray-300 dark:border-gray-600 dark:bg-gray-900/50 dark:text-gray-300 focus:border-blue-500 dark:focus:border-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 rounded-md shadow-sm transition-all duration-300">{{ old('deskripsi') }}</textarea>
                        </div>

                        <!-- Foto -->
                        <div class="transform transition-all duration-300 hover:scale-[1.01]">
                            <x-input-label for="foto" :value="__('Foto Barang')" class="text-gray-900 dark:text-gray-100 font-semibold" />
                            <div class="mt-1 flex items-center justify-center w-full">
                                <label for="foto" class="flex flex-col items-center justify-center w-full h-32 glass-card border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all duration-300 hover-lift">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 dark:text-gray-500 mb-3"></i>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Klik untuk upload</span> atau drag and drop</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG atau JPEG (MAX. 2MB)</p>
                                    </div>
                                    <input id="foto" name="foto" type="file" class="hidden" accept="image/*" />
                                </label>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('barang.index') }}" class="inline-flex items-center px-4 py-2 glass-card border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-50 dark:hover:bg-gray-700/50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-300 hover-lift">
                                <i class="fas fa-times mr-2"></i>
                                {{ __('Batal') }}
                            </a>

                            <x-primary-button class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-300 hover-lift glow shadow-lg">
                                <i class="fas fa-save mr-2"></i>
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>