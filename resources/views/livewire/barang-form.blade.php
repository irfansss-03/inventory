<div x-data="{ show: @entangle('showModal').live }" x-show="show" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background Overlay with Glass Effect -->
        <div x-show="show" 
             x-transition:enter="ease-out duration-300" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100" 
             x-transition:leave="ease-in duration-200" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0" 
             class="fixed inset-0 bg-gray-900/70 dark:bg-black/80 backdrop-blur-sm transition-opacity" 
             aria-hidden="true"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <!-- Modal Content with Glass Card -->
        <div x-show="show" 
             x-transition:enter="ease-out duration-300" 
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
             x-transition:leave="ease-in duration-200" 
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
             class="inline-block align-bottom glass-card rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full glow">
            
            <form wire:submit.prevent="save">
                <!-- Modal Header -->
                <div class="glass-card px-6 pt-6 pb-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2" id="modal-title">
                            <i class="fa-solid fa-box text-blue-600 dark:text-blue-400"></i>
                            {{ $barangId ? 'Edit Barang' : 'Tambah Barang' }}
                        </h3>
                        <button type="button" 
                                wire:click="$set('showModal', false)" 
                                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors">
                            <i class="fa-solid fa-times text-xl"></i>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="px-6 py-4 space-y-4 max-h-[60vh] overflow-y-auto">
                    
                    <!-- Nama Barang -->
                    <div class="fade-in">
                        <x-input-label for="nama" :value="__('Nama Barang')" class="text-gray-700 dark:text-gray-300 font-semibold" />
                        <x-text-input wire:model="nama" 
                                      id="nama" 
                                      class="block mt-2 w-full bg-white/80 dark:bg-gray-900/80 border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400 rounded-lg shadow-sm transition-all" 
                                      type="text" 
                                      required />
                        <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                    </div>

                    <!-- Kategori -->
                    <div class="fade-in">
                        <x-input-label for="kategori" :value="__('Kategori')" class="text-gray-700 dark:text-gray-300 font-semibold" />
                        <x-text-input wire:model="kategori" 
                                      id="kategori" 
                                      class="block mt-2 w-full bg-white/80 dark:bg-gray-900/80 border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400 rounded-lg shadow-sm transition-all" 
                                      type="text" 
                                      required />
                        <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
                    </div>

                    <!-- Stok -->
                    <div class="fade-in">
                        <x-input-label for="stok" :value="__('Stok')" class="text-gray-700 dark:text-gray-300 font-semibold" />
                        <x-text-input wire:model="stok" 
                                      id="stok" 
                                      class="block mt-2 w-full bg-white/80 dark:bg-gray-900/80 border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400 rounded-lg shadow-sm transition-all" 
                                      type="number" 
                                      required />
                        <x-input-error :messages="$errors->get('stok')" class="mt-2" />
                    </div>

                    <!-- Harga -->
                    <div class="fade-in">
                        <x-input-label for="harga" :value="__('Harga')" class="text-gray-700 dark:text-gray-300 font-semibold" />
                        <x-text-input wire:model="harga" 
                                      id="harga" 
                                      class="block mt-2 w-full bg-white/80 dark:bg-gray-900/80 border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400 rounded-lg shadow-sm transition-all" 
                                      type="number" 
                                      required />
                        <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                    </div>

                    <!-- Deskripsi -->
                    <div class="fade-in">
                        <x-input-label for="deskripsi" :value="__('Deskripsi')" class="text-gray-700 dark:text-gray-300 font-semibold" />
                        <textarea wire:model="deskripsi" 
                                  id="deskripsi" 
                                  rows="3"
                                  class="block mt-2 w-full bg-white/80 dark:bg-gray-900/80 border-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-blue-500 dark:focus:ring-blue-400 rounded-lg shadow-sm transition-all"></textarea>
                        <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                    </div>

                    <!-- Foto Upload -->
                    <div class="fade-in">
                        <x-input-label for="foto" :value="__('Foto Barang')" class="text-gray-700 dark:text-gray-300 font-semibold" />
                        <div class="mt-2 flex items-center justify-center w-full">
                            <label for="foto" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg cursor-pointer bg-white/50 dark:bg-gray-900/50 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-all">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fa-solid fa-cloud-arrow-up text-3xl text-gray-400 dark:text-gray-500 mb-2"></i>
                                    <p class="text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Klik untuk upload</span> atau drag & drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">PNG, JPG (MAX. 2MB)</p>
                                </div>
                                <input wire:model="foto" id="foto" type="file" class="hidden" accept="image/*">
                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                        
                        <!-- Image Preview -->
                        <div class="mt-3 flex justify-center">
                            @if ($oldFoto && !$foto)
                                <div class="relative group">
                                    <img src="{{ asset('storage/' . $oldFoto) }}" 
                                         class="w-24 h-24 object-cover rounded-lg shadow-lg border-2 border-gray-200 dark:border-gray-700">
                                    <div class="absolute inset-0 bg-black/50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <span class="text-white text-xs">Foto Lama</span>
                                    </div>
                                </div>
                            @endif
                            @if ($foto)
                                <div class="relative group">
                                    <img src="{{ $foto->temporaryUrl() }}" 
                                         class="w-24 h-24 object-cover rounded-lg shadow-lg border-2 border-blue-500 dark:border-blue-400 glow">
                                    <div class="absolute inset-0 bg-black/50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <span class="text-white text-xs">Foto Baru</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="glass-card px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
                    <button type="button" 
                            wire:click="$set('showModal', false)" 
                            class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-6 py-2.5 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg font-semibold text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all shadow-sm">
                        <i class="fa-solid fa-times"></i>
                        Batal
                    </button>
                    <button type="submit" 
                            class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 dark:from-blue-500 dark:to-blue-600 text-white rounded-lg font-semibold text-sm hover:from-blue-700 hover:to-blue-800 dark:hover:from-blue-600 dark:hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                        <i class="fa-solid fa-save"></i>
                        {{ $barangId ? 'Simpan Perubahan' : 'Tambah Barang' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>