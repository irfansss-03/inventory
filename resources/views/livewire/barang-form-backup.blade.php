<div x-data="{ show: @entangle('showModal').live }" x-show="show" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form wire:submit.prevent="save">
                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">
                                {{ $barangId ? 'Edit Barang' : 'Tambah Barang' }}
                            </h3>
                            <div class="mt-2">
                                {{-- Form Fields --}}
                                <div class="mb-4">
                                    <x-input-label for="nama" :value="__('Nama Barang')" />
                                    <x-text-input wire:model="nama" id="nama" class="block mt-1 w-full" type="text" required />
                                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                                </div>
                                <div class="mb-4">
                                    <x-input-label for="kategori" :value="__('Kategori')" />
                                    <x-text-input wire:model="kategori" id="kategori" class="block mt-1 w-full" type="text" required />
                                    <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                                </div>
                                <div class="mb-4">
                                    <x-input-label for="stok" :value="__('Stok')" />
                                    <x-text-input wire:model="stok" id="stok" class="block mt-1 w-full" type="number" required />
                                    <x-input-error :messages="$errors->get('stok')" class="mt-2" />
                                </div>
                                <div class="mb-4">
                                    <x-input-label for="harga" :value="__('Harga')" />
                                    <x-text-input wire:model="harga" id="harga" class="block mt-1 w-full" type="number" required />
                                    <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                                </div>
                                <div class="mb-4">
                                    <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                                    <textarea wire:model="deskripsi" id="deskripsi" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                                    <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                                </div>
                                <div class="mb-4">
                                    <x-input-label for="foto" :value="__('Foto')" />
                                    <input wire:model="foto" id="foto" type="file" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-200 dark:hover:file:bg-gray-600">
                                    <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                                    @if ($oldFoto && !$foto)
                                        <img src="{{ asset('storage/' . $oldFoto) }}" class="mt-2 w-20 h-20 object-cover rounded">
                                    @endif
                                    @if ($foto)
                                        <img src="{{ $foto->temporaryUrl() }}" class="mt-2 w-20 h-20 object-cover rounded">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                        {{ $barangId ? 'Simpan Perubahan' : 'Tambah Barang' }}
                    </button>
                    <button type="button" wire:click="$set('showModal', false)" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm dark:bg-gray-600 dark:text-gray-200 dark:hover:bg-gray-500">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>