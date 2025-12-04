<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if ($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600">Whoops! Ada yang salah.</div>
                            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('barang.update', $barang) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nama -->
                        <div>
                            <x-input-label for="nama" :value="__('Nama Barang')" />
                            <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama', $barang->nama)" required autofocus />
                        </div>

                        <!-- Kategori -->
                        <div class="mt-4">
                            <x-input-label for="kategori" :value="__('Kategori')" />
                            <x-text-input id="kategori" class="block mt-1 w-full" type="text" name="kategori" :value="old('kategori', $barang->kategori)" required />
                        </div>

                        <!-- Stok -->
                        <div class="mt-4">
                            <x-input-label for="stok" :value="__('Stok')" />
                            <x-text-input id="stok" class="block mt-1 w-full" type="number" name="stok" :value="old('stok', $barang->stok)" required />
                        </div>

                        <!-- Harga -->
                        <div class="mt-4">
                            <x-input-label for="harga" :value="__('Harga')" />
                            <x-text-input id="harga" class="block mt-1 w-full" type="number" name="harga" :value="old('harga', $barang->harga)" required step="1" />
                        </div>

                        <!-- Deskripsi -->
                        <div class="mt-4">
                            <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                            <textarea id="deskripsi" name="deskripsi" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('deskripsi', $barang->deskripsi) }}</textarea>
                        </div>

                        <!-- Foto -->
                        <div class="mt-4">
                            <x-input-label for="foto" :value="__('Foto Barang (Opsional)')" />
                            <input id="foto" name="foto" type="file" class="block mt-1 w-full text-gray-900 dark:text-gray-100">
                            @if ($barang->foto)
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Foto saat ini:</p>
                                    <img src="{{ asset('storage/' . $barang->foto) }}" alt="{{ $barang->nama }}" class="w-20 h-20 object-cover rounded mt-1">
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('barang.index') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                Batal
                            </a>

                            <x-primary-button class="ms-4">
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
